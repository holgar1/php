<?php
ignore_user_abort(true);
if (isset($_GET['link']) && isset($_GET['proxy'])) {
	$link = urldecode($_GET['link']);
	$proxy_param = urldecode($_GET['proxy']);
	$protocol = trim(explode("://", $proxy_param)[0]);
	$tmp = explode(":", trim(explode("://", $proxy_param)[1]));
	$user = trim($tmp[0]);
	$pass = trim($tmp[1]);
	$host = trim($tmp[2]);
	$port = trim($tmp[3]);
	$proxy = "$protocol://$user:$pass@$host:$port";
	$command = 'curl -i -k -L -w "|||%{url_effective}" -H "Host: et.interac.ca" -H "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.70 Safari/537.36" -H "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8" -H "Accept-Encoding: gzip, deflate" -H "Accept-Language: en-US,en;q=0.9" -H "Upgrade-Insecure-Requests: 1" --proxy ' . $proxy . ' --max-time 30 --compressed "' . $link . '"';
	echo htmlentities(shell_exec($command));
}
