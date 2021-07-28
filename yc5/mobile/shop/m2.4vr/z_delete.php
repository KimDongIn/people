<?php

// 첫번째 행 $dir="./files/" 에 자신이 삭제하고자 하는 폴더를 경로와 함께 써 넣는다//

$dir="";

function delete_dir($path) {

  @chmod($path,0777);

  $directory = dir($path);

  while($entry = $directory->read()) {

    if ($entry != "." && $entry != "..") {

      if (is_dir($path."/".$entry)) { 

        delete_dir($path."/".$entry);

      } else {

        @chmod($path."/".$entry,0777);

        @UnLink ($path."/".$entry);

      }

    }

  }

  $directory->close();

  @rmdir($path);

}

delete_dir($dir);

echo"삭제완료";

?>
