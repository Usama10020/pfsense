<!DOCTYPE html>
<html>
<body>
  <a href="firewall_rules.php?if=lan">Go Back</a>
  <br>
  <br>
  <br>
  <br>
  <?php
  require_once("functions.inc");
  init_config_arr(array('filter', 'rule'));
  filter_rules_sort();
  $a_filter = &$config['filter']['rule'];
  $usama_count = count($config['filter']['rule']);
  $usamanewlogic = NULL;
  $tracker_finder = -1;
  $usamafile = fopen("usama_log.txt", "r");
  if($usamafile){
    while(!feof($usamafile)){
      $prnt = fgetc($usamafile);
      echo $prnt;
      if($prnt == ')'){
        $tracker_finder = 0; 
      }
      if($tracker_finder == 1){
        $usamanewlogic .= $prnt;
      }
      if($prnt == '('){
        $tracker_finder = 1; 
      }
      if($prnt == ';'){
        echo str_repeat('&nbsp;', 4);
        settype($usamanewlogic,getType(intval((int)$usamanewlogic)));
        $linker = NULL;
        $link_or_not = -10;
        for ($x = 0; $x < $usama_count; $x++){
          $linker = $a_filter[$x]['tracker'];
          if($linker == $usamanewlogic){
            $link_or_not = $x;
            break;
          }
        }
        if ($link_or_not != -10){
          $usamanewlogic = "firewall_rules_edit.php?id=" .$link_or_not;
          echo "<a href='".$usamanewlogic."'>View Details</a>";
        }
        $link_or_not = -10;
        $linker = NULL;
        $usamanewlogic = NULL;
        echo nl2br("\n",false);
        echo nl2br("\n",false);
      }
    }
  }
  fclose($usamafile);
  ?>
  <br>
  <br>
  <a href="firewall_rules.php?if=lan">Go Back</a>
  </body>
</html>
