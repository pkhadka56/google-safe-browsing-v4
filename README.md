# google-safe-browsing-v4.php
This is for test purpose. I stumbled on internet and able to list Google deceptive websites using Google APIv4. 
This is written in php. I am not a programmer so there might be mistakes or things that I have done wrong. If you want to make it yours, feel free to do it. Any help to make code better will be appreciated.  Thanks.

# How to use?
Make sure you have another file called sites.txt in same folder where each line content one domain name. You can find sample inside sites.txt.

Secondly, you should get your own API-KEY and replace YOUR-API-KEY in google-deceptive-sites.php file. Get started [here](https://developers.google.com/safe-browsing/v4/get-started) 

Then, in command line run following
```
/usr/bin/php -f google-deceptive-sites.php > google-deceptive-malware.html
```

google-deceptive-malware.html will look like below if you browse from your browser:

![ScreenShot](https://raw.githubusercontent.com/pkhadka56/google-safe-browsing-v4.php/master/screenshot.png)
