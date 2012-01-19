<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stemmer
{
    function stem($word)
    {
        if(empty($word)){
            return false;
        }
        $result='';
        $word=strtolower($word);
        // Strip punctuation, etc.
        if(substr($word,-2)=="'s"){
            $word = substr($word, 0, -2);
        }
        $word=preg_replace('/[^a-z0-9 ]/','', $word);
        $first = '';
        if ( strpos($word,'-')!== false ) {
            list($first, $word) = explode('-', $word);
            $first .= '-';
        }
        return $first.$word;
    }
}
?>