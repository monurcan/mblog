<?php
    header('Content-Type: application/json');

    function DQGetRecentComments($parameters){
        if(!isset($parameters['APIKey']) || !isset($parameters['forumName'])) return FALSE;
        if(!isset($parameters['commentCount'])) $parameters['commentCount'] = 25;
        if(!isset($parameters['commentLength'])) $parameters['commentLength'] = 100;
        $DQCommentsAPILink = "http://disqus.com/api/3.0/posts/list.json?limit={$parameters['commentCount']}&api_key={$parameters['APIKey']}&forum={$parameters['forumName']}&include=approved";
        $DQJsonCommentResponse = DQGetJson($DQCommentsAPILink);
        if($DQJsonCommentResponse != FALSE) {
            $DQRawComments = @json_decode($DQJsonCommentResponse, true);
            $DQComments = $DQRawComments['response'];
            for($index = 0; $index < count($DQComments); $index++) {
                $DQThreadAPILink = "http://disqus.com/api/3.0/threads/details.json?api_key={$parameters['APIKey']}&thread={$DQComments[$index]['thread']}";
                $DQJsonThreadResponse = DQGetJson($DQThreadAPILink);
                $DQRawThread = @json_decode($DQJsonThreadResponse, true);
                $DQThread = $DQRawThread['response'];
                if($DQThread != FALSE) {
                    $DQComments[$index]['pageTitle'] = $DQThread['title'];
                    $DQComments[$index]['pageURL'] = $DQThread['link'];
                } else {
                    $DQComments[$index]['pageTitle'] = 'Page Not Found';
                    $DQComments[$index]['pageURL'] = '#';
                }
                $DQComments[$index]['authorName'] = $DQComments[$index]['author']['name'];
                $DQComments[$index]['authorProfileURL'] = $DQComments[$index]['author']['profileUrl'];
                $DQComments[$index]['authorAvatar'] = $DQComments[$index]['author']['avatar']['cache'];
                $DQComments[$index]['message'] = DQLimitLength($DQComments[$index]['raw_message'], $parameters['commentLength']);
                unset($DQComments[$index]['isJuliaFlagged']);
                unset($DQComments[$index]['isFlagged']);
                unset($DQComments[$index]['forum']);
                unset($DQComments[$index]['parent']);
                unset($DQComments[$index]['author']);
                unset($DQComments[$index]['media']);
                unset($DQComments[$index]['isDeleted']);
                unset($DQComments[$index]['isApproved']);
                unset($DQComments[$index]['dislikes']);
                unset($DQComments[$index]['raw_message']);
                unset($DQComments[$index]['id']);
                unset($DQComments[$index]['thread']);
                unset($DQComments[$index]['numReports']);
                unset($DQComments[$index]['isEdited']);
                unset($DQComments[$index]['isSpam']);
                unset($DQComments[$index]['isHighlighted']);
                unset($DQComments[$index]['points']);
                unset($DQComments[$index]['likes']);                
            }
            return $DQComments;
        }
    }
    
    function DQGetJson($DQAPILink) {
        $DQcURL = curl_init();
        curl_setopt($DQcURL, CURLOPT_HEADER, FALSE);
        curl_setopt($DQcURL, CURLOPT_URL, $DQAPILink);
        curl_setopt($DQcURL, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($DQcURL, CURLOPT_FRESH_CONNECT, TRUE);
        curl_setopt($DQcURL, CURLOPT_FORBID_REUSE, TRUE);
        $DQJsonResponse = curl_exec($DQcURL);
        curl_close($DQcURL);
        return $DQJsonResponse;
    }
    
    function DQLimitLength($string, $maxLength) {
        if(strlen($string) <= $maxLength) {
            return $string;
        } else {
            return substr($string, 0, $maxLength)."...";
        }
    }

    // Make an array for the parameters.
    $parameters = array(
            'APIKey' => 'O2pJX62LvpnHmBwJEyLOl8ajWMUDBAq1gYpmR5UjG4aGtnGC9LUTb7HmlAucLZNX',
            'forumName' => 'denemeblogphpmarkdown',
            'commentCount' => 4,
            'commentLength' => 95
    );
     
    // Using the DQGetRecentComments() function.
    $DQComments = DQGetRecentComments($parameters);
    $file = "last-comments.txt";
    $fh = fopen($file, 'w') or die("can't open file");
    fwrite($fh, json_encode($DQComments));
    fclose($fh);

    if(file_exists($file)){
        echo $file." successfully written (".round(filesize($file)/1024)."KB)";
    }else {
        echo "Error encountered. File could not be written.";
    }
?>