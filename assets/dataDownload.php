<?php
session_start();
ob_start();

# ---------------------------
# FUNCTIONS/CLASSES
# ---------------------------

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

class FlxZipArchive extends ZipArchive {
    /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/

    public function addDir($location, $name) {
        $this->addEmptyDir($name);

        $this->addDirDo($location, $name);
     } // EO addDir;

    /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann
     * @access private   **/
    private function addDirDo($location, $name) {
        $name .= '/';
        $location .= '/';

        // Read all Files in Dir
        $dir = opendir ($location);
        while ($file = readdir($dir))
        {
            if ($file == '.' || $file == '..') continue;
            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
            $this->$do($location . $file, $name . $file);
        }
    } // EO addDirDo();
}

# ---------------------------
# OUTPUT FILE PARAMS
# ---------------------------

# download zip once done
$download_file= true;

date_default_timezone_set('America/New_York');

$page_load_date = clean(date("m.d.y"));
$page_load_time = clean(date("h:i:sa"));

# GET URL PARAMS
# if study name given, check if data folder exists, if doesn't create it, if does, set as foldername
if(isset($_GET['study']) && !empty($_GET['study'])) {
    $_SESSION['study_dl'] = $_GET['study'];
    $data_path = $_SERVER['DOCUMENT_ROOT']."/aospan/data/".$_SESSION['study_dl'];
    if (!file_exists($data_path)) {
        echo "Sorry, you did not specify a valid study name";
    } else {
        # create zip file name based on page load time
        $zip_file_name = 'zip/AOSPAN_STUDY-'.$_SESSION['study_dl']."-".$page_load_date."_".$page_load_time.'.zip';

        if($data_path != "NO_STUDY"){
            $za = new FlxZipArchive;
            $res = $za->open($zip_file_name, ZipArchive::CREATE);
            if($res === TRUE) 
            {
                $za->addDir($data_path, basename($data_path));
                $za->close();
            }
            else  { echo 'Could not create a zip archive';}
        }

        if ($download_file)
        {
            ob_get_clean();
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-Type: application/zip");
            header("Content-Disposition: attachment; filename=" . basename($zip_file_name) . ";" );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($zip_file_name));
            readfile($zip_file_name);
        }
    }
} else {
    $_SESSION['study_dl'] = "---";
    $data_path = "NO_STUDY";
    echo "Please specify a valid study name in the URL.  Contact nelsonroquejr@gmail.com for details";
}

# DEBUGGING
// echo("<hr>");
// echo($page_load_datetime);
// echo("<br>");
// echo $data_path;
?>