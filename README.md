## Mentorship project Bloknot - API creation

This is a mentorship project which illustrates how to create a LAMP-based REST API for the note-taking web application "Bloknot". You may use it as a template for your own projects. 

Following steps should be executed in order to build development environment based on LAMP (Linux, Apache, MariaDB, PHP), create and fill test database.

##### Create a LAMP Docker container with working folder at your project folder
###### Note: Please replace `/Users/oleg.snegirev/Projects/Personal/mentorship/bloknot` with your own project path!
```
docker run --name=bloknot_api --rm -p 8080:80 -e LOG_STDOUT=true -e LOG_STDERR=true -e LOG_LEVEL=debug -v '/Users/oleg.snegirev/Projects/Personal/mentorship/bloknot':/var/www/html fauria/lamp
```

##### Get inside a running container and open a MariaDB console
```
docker exec -i -t bloknot_api bash
mysql -u root
```

##### Create DB
```
CREATE DATABASE bloknot_db;
CREATE USER 'bloknot_db_user'@'localhost' IDENTIFIED BY 'b10kn0Tpsw1789';
GRANT ALL PRIVILEGES ON bloknot_db.* TO 'bloknot_db_user'@'localhost';
FLUSH PRIVILEGES;
```

##### Create tables
```
CREATE TABLE IF NOT EXISTS categories (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(256) NOT NULL,
`description` text NOT NULL,
`created` datetime NOT NULL,
`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3;
```

```
CREATE TABLE IF NOT EXISTS `notes` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(256) NOT NULL,
`text` text NOT NULL,
`category_id` int(11) NOT NULL,
`created` datetime NOT NULL,
`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3; initial
```

##### Fill DB with the initial data
```
INSERT INTO `categories` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Work', 'Category for anything related to my professional activities.', '2019-12-14 00:35:07', '2019-12-14 17:34:33'),
(2, 'Personal', 'Personal notes and journal.', '2019-12-14 00:35:07', '2019-12-14 17:34:33');

INSERT INTO `notes` (`id`, `name`, `text`, `category_id`, `created`, `modified`) VALUES
(1, 'My first awesome note!', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eu suscipit velit. Mauris in libero non massa elementum fermentum. Nulla rutrum ex et tempor dignissim. Aliquam bibendum eros fermentum, finibus augue auctor, ornare urna. Curabitur dictum pulvinar libero sed facilisis. Curabitur sit amet malesuada ligula, ultricies mattis sapien. Cras consequat tincidunt magna in molestie. Vivamus sed velit finibus nisi pellentesque gravida ut ac quam. Donec eget enim vehicula, ultrices purus sed, mollis dolor. In sagittis dolor scelerisque felis scelerisque porttitor a a metus. Etiam eu posuere odio, vitae viverra augue.', 2, '2019-12-14 18:02:26', '2019-12-14 18:12:26');
```