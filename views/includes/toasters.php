<?php

// var_dump($_SESSION);
if(Session::getSession("add") != null){
  $data = explode(" ", Session::getSession("add"));
  Util::createToastr($data[2], array("message" => Session::getSession("add"), "title" => $data[0] ." ". $data[1]));
  Session::unsetSession("add");
}
if(Session::getSession("delete") != null){
  $data = explode(" ", Session::getSession("delete"));
  Util::createToastr($data[2], array("message" => Session::getSession("delete"), "title" => $data[0] ." ". $data[1]));
  Session::unsetSession("delete");
}
if(Session::getSession("edit") != null){
  $data = explode(" ", Session::getSession("edit"));
  Util::createToastr($data[2], array("message" => Session::getSession("edit"), "title" => $data[0] ." ". $data[1]));
  Session::unsetSession("edit");
}
if(Session::getSession("validation") != null){
  $data = explode(" ", Session::getSession("validation"));
  Util::createToastr($data[2], array("message" => Session::getSession("validation"), "title" => $data[0] ." ". $data[1]));
  Session::unsetSession("validation");
}

if(Session::getSession("csrf") != null){
  $data = explode(" ", Session::getSession("csrf"));
  Util::createToastr($data[1], array("message" => Session::getSession("csrf"), "title" => $data[0]));
  Session::unsetSession("csrf");
}