**Starting A New Project:**

To start a new project please set up your environment variables in the config/testing folder and in the index.php folder. 

Also run 


```
#!php

php composer.phar install 
```



**Composer**

Composer is also installed on the framework. You can add libraries by adding them in the composer.json file in the root directory. You will then need to run composer from the cli to pull it down. If you have updated composer.json, run the following command from the CLI.
```
#!php

php composer.phar update
```

**Grunt**

Grunt also handles the front end preprocessing. You need to navigate into /assets/admin or /assets/site and run the following command when when making LESS changes or JS changes.
```
#!php

grunt watch
```