<?php

function gravatar_url($name)
{
//$email = md5($email);
return "https://i.pravatar.cc/60?u={{$name}}" ;// można dodać tutaj gravatara
}
