function getFileList($dirpath)
    {
        $filelist = array();
        if ($handle = opendir(dirname ($dirpath))) 
        {
           while (false !== ($file = readdir($handle)))
              {
                    $filelist[] = $file;
              }
            closedir($handle);
        }

        return $filelist;
    }