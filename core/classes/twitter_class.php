<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of twitter_class
 *
 * @author mohamed
 * @access public
 */
class twitter_class {
    
    public function __construct($string) {
        echo 'successfully created new Twitter Class<br />';
        $this->welcome($string);
    }
    
    public function welcome($string){
        $Consumer_Key       = 'CT6dseET6VogG56GDVA';
        $Consumer_Secret    = '9UYI37bdaEwZEvUB8xl0FimtC58pW3pjtAaPb0';
        $Access_Token       = '129269183-sn60sB4NU4hHKxwt35ZsxNYptVo5Zt4nUHus0wcv';
        $Access_Token_Secret= 'yK0GKkZ5fmCkdjTJqFBwm6TbZZJDYMeQcbNbBHt9Mk';
        
        $tweet = new TwitterOAuth($Consumer_Key, $Consumer_Secret, $Access_Token, $Access_Token_Secret);
        if (isset($string)) {
            $tweetmsg = $string;
            $tweet->post('statuses/update',array('status' => $tweetmsg));
            echo "Your message has been sent to Twitter.";
        } else {
            echo "Your message has not been sent to Twitter.";
        }
    }
    
}

?>
