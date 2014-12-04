<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class notes_model extends CI_Model
{
    public $table_note = 'note';
    public $table_vote = 'rate';
    public $table_comments = 'comments';
    
    public static $default_path = 'assets/repo.d/';
    
            
    function create_note($author_id, $author_pseudo, $author_email, $path, $note_name, $file_name, $cat_id)
    {
        $git_repo = $this->open_note_repo($path, $author_pseudo, $author_email);
        
        $git_repo->add();
        $git_repo->commit('Première version');
        
        //insert data on database
        $note_array = array('path' => $path,
                            'file_name' => $file_name,
                            'name' => $note_name,
                            'visible' => 1,
                            'category' => $cat_id,
                            'author_id' => $author_id,
                            'creation_date' => date("Y-m-d H:i:s"),
                            'modification_date' => date("Y-m-d H:i:s"));
        
        $this->db->insert('note', $note_array);
        $note_id = $this->db->insert_id();
        return $note_id;
    }
    
    function get_note_content($note_id)
    {        
        $note_content = array();
        $buffer = '';
        
        $note_result = $this->db->get_where('note', "id = $note_id", 1)
                                ->result_array();
        $note_path = $note_result[0]['path'].$note_result[0]['file_name'];
        
        $file = fopen($note_path, 'r');
        if($file)
        {
            while (($buffer = fgets($file)) !== false)
            {
                $note_content[] = $buffer;
            }
            fclose($file);
        }
        $note_data = $note_result[0];
        $note_data['note_content'] = $note_content;
        return $note_data;
    }
            
    function rate_note($note_id, $user_id, $value)
    {
        if(!is_int($note_id) && !is_int($user_id) && !is_bool($value))
            return false;
        $this->db->insert($this->table_vote, array('note_id' => $note_id, 
                                                   'user_id' => $user_id,
                                                   'vote' => $value));
        return true;
    }
    
    function modify_note($note_id, $user_id, $note_content, $modify_note_comment)
    {
        //get note data from db
        $note_data = $this->get_db_note_info($note_id);

        //get user data from db
        $user_data = $this->get_db_user_info($user_id);

        //apply modification to file and commit change into Git repository
        $note_repo = $this->open_note_repo($note_data->path, $user_data->pseudo, $user_data->email);

            //write modification to file
        $note_file = fopen($note_data->path . $note_data->file_name, "w+");
        fwrite($note_file, $note_content);
        fclose($note_file);

            //commit changment
        $note_repo->commit($modify_note_comment);

        //update note data last_update
        $this->db->update_string('note', array('modification_date' => '\''.date("Y-m-d H:i:s").'\''), array('id' => $note_id));
    }
    
    function get_note_history($note_id)
    {
        $note_data = $this->get_db_note_info($note_id);
        $repository = $this->open_note_repo($note_data->path);
        
        //get commit history from repository
        $history_str = $repository->run("log --pretty=format:\"%H|%an|%ae|%ar|%s\"");
        
        //build array from history string
        $tmp_array = explode(PHP_EOL, $history_str);
        $history_array = array();
        foreach ($tmp_array as $current_lign) {
            $data_array = explode('|', $current_lign);
            $tmp_array = array( 'commit_hash' => $data_array[0],
                                'user_pseudo' => $data_array[1],
                                'user_mail' => $data_array[2],
                                'date_relative' => $data_array[3],
                                'commit_message' => $data_array[4]);
            $history_array[] = $tmp_array;
        }
        return $history_array;
    }
    
    function revert_note($repo_path, $commit_hash)
    {
        $repo = $this->open_note_repo($repo_path);
        $repo->run('checkout '. $commit_hash .' .'); // str end dot is VERY IMPORTANT - DO NOT REMOVE IT
        $repo->commit('retour à la version : '.$commit_hash);
    }
    
    function note_diff($note_id, $history_point)
    {
        //get note data from note_id
        $note_data = $this->get_note_content($note_id);
        
        //get traeted data from diff return
        $diff_return = $this->_get_diff_info($note_data['path'], $history_point);
        
        $data = array('previous' => $note_data['note_content'],
                      'current' => $note_data['note_content']);
        
        foreach($diff_return as $chunk)
        {
            $this->_build_final_array($chunk, 'previous', $data['previous']);
            $this->_build_final_array($chunk, 'current', $data['current']);
        }
        return $data;
    }
    
    private function open_note_repo($repo_path, $user_name = NULL, $user_mail = NULL)
    {
        $repository = Git::open($repo_path);
        if(!is_null($user_mail) && !is_null($user_name))
        {
            $repository->run('config user.name "'.$user_name.'"');
            $repository->run('config user.email "'.$user_mail.'"');
        }
        return $repository;
    }
    
    private function get_db_note_info($note_id)
    {
        $return_from_db = $this->db->get_where('note', "id = $note_id", 1)
                                   ->result();
        return $return_from_db[0];
    }
    
    private function get_db_user_info($user_id)
    {
        $return_from_db = $this->db->get_where('user', "id = $user_id", 1)
                                   ->result();
        return $return_from_db[0];
    }
    
    
    private function _get_diff_info($repo_path, $commit_hash) {
        //open repo
        $repo = Git::open($repo_path);

        //get git_diff from given commit
        $diff_return = $repo->diff(false, ' '.$commit_hash);

        //diff return treatment

        $xpl_str = explode('@@', $diff_return);

        $diff_array = array();

        //isolate data and get begin and duration line from every chunk
        for ($index = 1; $index < count($xpl_str); $index+=2) {

            $diff_element = array();
            $diff_element['diff_info'] = array();

            //add diff content in array (line by line)
            $diff_element['diff_content'] = explode(PHP_EOL, $xpl_str[$index + 1]);

            //isolate diff_info previous and current
            $tmp = explode(' ', $xpl_str[$index]);

            //remove unnecessary index inside array
            array_pop($tmp);
            array_shift($tmp);

            //get begin line et duration line from diff_info whashed by str_replace to remove '+' and '-'
            $previous_tmp = explode(',', str_replace('-', '', $tmp[0]));
            $current_tmp = explode(',', str_replace('+', '', $tmp[1]));

            //add obtains info inside array
            $diff_element['diff_info']['previous']['begin_line'] = (int) $previous_tmp[0];
            $diff_element['diff_info']['previous']['duration_line'] = (int) $previous_tmp[1];

            $diff_element['diff_info']['current']['begin_line'] = (int) $current_tmp[0];
            $diff_element['diff_info']['current']['duration_line'] = (int) $current_tmp[1];
            $diff_array[] = $diff_element;

            $diff_note = array();

            }

            //build array of previous and current state of file
            for($i = 0; $i < count($diff_array); $i++){
                $previous_note = array();
                $current_note = array();
                foreach ($diff_array[$i]['diff_content'] as $line) {
                    if (empty($line)) {
                        $previous_note[] = "";
                        $current_note[] = "";
                    } elseif ($line[0] == ' ') {
                        $line[0] = '';
                        $previous_note[] = $line;
                        $current_note[] = $line;
                    } elseif ($line[0] == '-')
                        $previous_note[] = $line;
                    elseif ($line[0] == '+')
                        $current_note[] = $line;
                    else {

                    }
                }
                $diff_array[$i]['diff_content'] = array('previous' => $previous_note,
                                                        'current' => $current_note);
            }
        return $diff_array;
    }

    private function _build_final_array($chunk, $prevOrCurrent, &$content) {

        $begin = $chunk['diff_info'][$prevOrCurrent]['begin_line'];
        $duration = $chunk['diff_info'][$prevOrCurrent]['duration_line'];

        $start_index_diff = ($begin != 1 ) ? 1 : 0;
        for ($i = $begin - 1, $j = $start_index_diff, $count = 0; $count < $duration; $i++, $j++, $count++) {
            $content[$i] = $chunk['diff_content'][$prevOrCurrent][$j];
        }
    }
}




/*Git.php
 * 
 */
class Git {
	/**
	 * Git executable location
	 *
	 * @var string
	 */
	protected static $bin = '/usr/bin/git';
	/**
	 * Sets git executable path
	 *
	 * @param string $path executable location
	 */
	public static function set_bin($path) {
		self::$bin = $path;
	}
	/**
	 * Gets git executable path
	 */
	public static function get_bin() {
		return self::$bin;
	}
	
	/**
	 * Sets up library for use in a default Windows environment
	 */
	public static function windows_mode() {
		self::set_bin('git');
	}
	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @return  GitRepo
	 */
	public static function &create($repo_path, $source = null) {
		return GitRepo::create_new($repo_path, $source);
	}
	/**
	 * Open an existing git repository
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @return  GitRepo
	 */
	public static function open($repo_path) {
		return new GitRepo($repo_path);
	}
	
	/**
	 * Clones a remote repo into a directory and then returns a GitRepo object
	 * for the newly created local repo
	 * 
	 * Accepts a creation path and a remote to clone from
	 * 
	 * @access  public
	 * @param   string  repository path
	 * @param   string  remote source
	 * @return  GitRepo
	 **/
	public static function &clone_remote($repo_path, $remote) {
		return GitRepo::create_new($repo_path, $remote, true);
	}
	/**
	 * Checks if a variable is an instance of GitRepo
	 *
	 * Accepts a variable
	 *
	 * @access  public
	 * @param   mixed   variable
	 * @return  bool
	 */
	public static function is_repo($var) {
		return (get_class($var) == 'GitRepo');
	}
}
// ------------------------------------------------------------------------
/**
 * Git Repository Interface Class
 *
 * This class enables the creating, reading, and manipulation
 * of a git repository
 *
 * @class  GitRepo
 */
class GitRepo {
	protected $repo_path = null;
	protected $bare = false;
	protected $envopts = array();
	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @return  GitRepo
	 */
	public static function &create_new($repo_path, $source = null, $remote_source = false) {
		if (is_dir($repo_path) && file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
			throw new Exception('"'.$repo_path.'" is already a git repository');
		} else {
			$repo = new self($repo_path, true, false);
			if (is_string($source)) {
				if ($remote_source) {
					$repo->clone_remote($source);
				} else {
					$repo->clone_from($source);
				}
			} else {
				$repo->run('init');
			}
			return $repo;
		}
	}
	/**
	 * Constructor
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @return  void
	 */
	public function __construct($repo_path = null, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			$this->set_repo_path($repo_path, $create_new, $_init);
		}
	}
	/**
	 * Set the repository's path
	 *
	 * Accepts the repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @param   bool    initialize new Git repo if not exists?
	 * @return  void
	 */
	public function set_repo_path($repo_path, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			if ($new_path = realpath($repo_path)) {
				$repo_path = $new_path;
				if (is_dir($repo_path)) {
					// Is this a work tree?
					if (file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
						$this->repo_path = $repo_path;
						$this->bare = false;
					// Is this a bare repo?
					} else if (is_file($repo_path."/config")) {
					  $parse_ini = parse_ini_file($repo_path."/config");
						if ($parse_ini['bare']) {
							$this->repo_path = $repo_path;
							$this->bare = true;
						}
					} else {
						if ($create_new) {
							$this->repo_path = $repo_path;
							if ($_init) {
								$this->run('init');
							}
						} else {
							throw new Exception('"'.$repo_path.'" is not a git repository');
						}
					}
				} else {
					throw new Exception('"'.$repo_path.'" is not a directory');
				}
			} else {
				if ($create_new) {
					if ($parent = realpath(dirname($repo_path))) {
						mkdir($repo_path);
						$this->repo_path = $repo_path;
						if ($_init) $this->run('init');
					} else {
						throw new Exception('cannot create repository in non-existent directory');
					}
				} else {
					throw new Exception('"'.$repo_path.'" does not exist');
				}
			}
		}
	}
	/**
	 * Tests if git is installed
	 *
	 * @access  public
	 * @return  bool
	 */
	public function test_git() {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		$resource = proc_open(Git::get_bin(), $descriptorspec, $pipes);
		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}
		$status = trim(proc_close($resource));
		return ($status != 127);
	}
	/**
	 * Run a command in the git repository
	 *
	 * Accepts a shell command to run
	 *
	 * @access  protected
	 * @param   string  command to run
	 * @return  string
	 */
	protected function run_command($command) {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		/* Depending on the value of variables_order, $_ENV may be empty.
		 * In that case, we have to explicitly set the new variables with
		 * putenv, and call proc_open with env=null to inherit the reset
		 * of the system.
		 *
		 * This is kind of crappy because we cannot easily restore just those
		 * variables afterwards.
		 *
		 * If $_ENV is not empty, then we can just copy it and be done with it.
		 */
		if(count($_ENV) === 0) {
			$env = NULL;
			foreach($this->envopts as $k => $v) {
				putenv(sprintf("%s=%s",$k,$v));
			}
		} else {
			$env = array_merge($_ENV, $this->envopts);
		}
		$cwd = $this->repo_path;
		$resource = proc_open($command, $descriptorspec, $pipes, $cwd, $env);
		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}
		$status = trim(proc_close($resource));
		if ($status) throw new Exception($stderr);
		return $stdout;
	}
	/**
	 * Run a git command in the git repository
	 *
	 * Accepts a git command to run
	 *
	 * @access  public
	 * @param   string  command to run
	 * @return  string
	 */
	public function run($command) {
		return $this->run_command(Git::get_bin()." ".$command);
	}
	/**
	 * Runs a 'git status' call
	 *
	 * Accept a convert to HTML bool
	 * 
	 * @access public
	 * @param bool  return string with <br />
	 * @return string
	 */
	public function status($html = false) {
		$msg = $this->run("status");
		if ($html == true) {
			$msg = str_replace("\n", "<br />", $msg);
		}
		return $msg;
	}

	/**
	 * Runs a 'git log' call
	 *
	 * Accept a convert to HTML bool
	 * 
	 * @access public
	 * @param bool  return string with <br />
	 * @return string
	 */
	public function log($html = false) {
		$msg = $this->run("log --pretty=format:\"%h - %an, %ar : %s %n\"");
		if ($html == true) {
			$msg = str_replace("\n", "<br />", $msg);
		}
		return $msg;
	}

	/**
	 * Runs a 'git revert' call
	 *
	 * Accept a convert to HTML bool
	 * 
	 * @access public
	 * @param int specifies which commit to revert.
	 * example : To revert last commit put 1, the one before the last 2,...
	 * @return string
	 */
	public function revert($commit) {
		$msg = $this->run("revert HEAD~".$commit);
		if ($html == true) {
			$msg = str_replace("\n", "<br />", $msg);
		}
		return $msg;
	}

	/**
	 * Runs a 'git diff' call
	 *
	 * Accept a convert to HTML bool
	 * 
	 * @access public
	 * @param bool  return string with <br />
	 * @param string additional parameters
	 * @return string
	 */
	public function diff($html = false,$cmd) {
		$msg = $this->run("diff".$cmd);
		if ($html == true) {
			$msg = str_replace("\n", "<br />", $msg);
		}
		return $msg;
	}


	/**
	 * Runs a `git add` call
	 *
	 * Accepts a list of files to add
	 *
	 * @access  public
	 * @param   mixed   files to add
	 * @return  string
	 */
	public function add($files = "*") {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("add $files -v");
	}
	
	/**
	 * Runs a `git rm` call
	 *
	 * Accepts a list of files to remove
	 *
	 * @access  public
	 * @param   mixed    files to remove
	 * @param   Boolean  use the --cached flag?
	 * @return  string
	 */
	public function rm($files = "*", $cached = false) {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("rm ".($cached ? '--cached ' : '').$files);
	}
	/**
	 * Runs a `git commit` call
	 *
	 * Accepts a commit message string
	 *
	 * @access  public
	 * @param   string  commit message
	 * @param   boolean  should all files be committed automatically (-a flag)
	 * @return  string
	 */
	public function commit($message = "", $commit_all = true) {
		$flags = $commit_all ? '-av' : '-v';
		return $this->run("commit ".$flags." -m ".escapeshellarg($message));
	}
	/**
	 * Runs a `git clone` call to clone the current repository
	 * into a different directory
	 *
	 * Accepts a target directory
	 *
	 * @access  public
	 * @param   string  target directory
	 * @return  string
	 */
	public function clone_to($target) {
		return $this->run("clone --local ".$this->repo_path." $target");
	}
	/**
	 * Runs a `git clone` call to clone a different repository
	 * into the current repository
	 *
	 * Accepts a source directory
	 *
	 * @access  public
	 * @param   string  source directory
	 * @return  string
	 */
	public function clone_from($source) {
		return $this->run("clone --local $source ".$this->repo_path);
	}
	/**
	 * Runs a `git clone` call to clone a remote repository
	 * into the current repository
	 *
	 * Accepts a source url
	 *
	 * @access  public
	 * @param   string  source url
	 * @return  string
	 */
	public function clone_remote($source) {
		return $this->run("clone $source ".$this->repo_path);
	}
	/**
	 * Runs a `git clean` call
	 *
	 * Accepts a remove directories flag
	 *
	 * @access  public
	 * @param   bool    delete directories?
	 * @param   bool    force clean?
	 * @return  string
	 */
	public function clean($dirs = false, $force = false) {
		return $this->run("clean".(($force) ? " -f" : "").(($dirs) ? " -d" : ""));
	}
	/**
	 * Runs a `git branch` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function create_branch($branch) {
		return $this->run("branch $branch");
	}
	/**
	 * Runs a `git branch -[d|D]` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function delete_branch($branch, $force = false) {
		return $this->run("branch ".(($force) ? '-D' : '-d')." $branch");
	}
	/**
	 * Runs a `git branch` call
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on active branch
	 * @return  array
	 */
	public function list_branches($keep_asterisk = false) {
		$branchArray = explode("\n", $this->run("branch"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if (! $keep_asterisk) {
				$branch = str_replace("* ", "", $branch);
			}
			if ($branch == "") {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}
	/**
	 * Lists remote branches (using `git branch -r`).
	 *
	 * Also strips out the HEAD reference (e.g. "origin/HEAD -> origin/master").
	 *
	 * @access  public
	 * @return  array
	 */
	public function list_remote_branches() {
		$branchArray = explode("\n", $this->run("branch -r"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if ($branch == "" || strpos($branch, 'HEAD -> ') !== false) {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}
	/**
	 * Returns name of active branch
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on branch name
	 * @return  string
	 */
	public function active_branch($keep_asterisk = false) {
		$branchArray = $this->list_branches(true);
		$active_branch = preg_grep("/^\*/", $branchArray);
		reset($active_branch);
		if ($keep_asterisk) {
			return current($active_branch);
		} else {
			return str_replace("* ", "", current($active_branch));
		}
	}
	/**
	 * Runs a `git checkout` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function checkout($branch) {
		return $this->run("checkout $branch");
	}
	/**
	 * Runs a `git merge` call
	 *
	 * Accepts a name for the branch to be merged
	 *
	 * @access  public
	 * @param   string $branch
	 * @return  string
	 */
	public function merge($branch) {
		return $this->run("merge $branch --no-ff");
	}
	/**
	 * Runs a git fetch on the current branch
	 *
	 * @access  public
	 * @return  string
	 */
	public function fetch() {
		return $this->run("fetch");
	}
	/**
	 * Add a new tag on the current position
	 *
	 * Accepts the name for the tag and the message
	 *
	 * @param string $tag
	 * @param string $message
	 * @return string
	 */
	public function add_tag($tag, $message = null) {
		if ($message === null) {
			$message = $tag;
		}
		return $this->run("tag -a $tag -m $message");
	}
	/**
	 * List all the available repository tags.
	 *
	 * Optionally, accept a shell wildcard pattern and return only tags matching it.
	 *
	 * @access	public
	 * @param	string	$pattern	Shell wildcard pattern to match tags against.
	 * @return	array				Available repository tags.
	 */
	public function list_tags($pattern = null) {
		$tagArray = explode("\n", $this->run("tag -l $pattern"));
		foreach ($tagArray as $i => &$tag) {
			$tag = trim($tag);
			if ($tag == '') {
				unset($tagArray[$i]);
			}
		}
		return $tagArray;
	}
	/**
	 * Push specific branch to a remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function push($remote, $branch) {
		return $this->run("push --tags $remote $branch");
	}
	/**
	 * Pull specific branch from remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function pull($remote, $branch) {
		return $this->run("pull $remote $branch");
	}
	/**
	 * Sets the project description.
	 *
	 * @param string $new
	 */
	public function set_description($new) {
		file_put_contents($this->repo_path."/.git/description", $new);
	}
	/**
	 * Gets the project description.
	 *
	 * @return string
	 */
	public function get_description() {
		return file_get_contents($this->repo_path."/.git/description");
	}
	/**
	 * Sets custom environment options for calling Git
	 *
	 * @param string key
	 * @param string value
	 */
	public function setenv($key, $value) {
		$this->envopts[$key] = $value;
	}
}
/* End of file */