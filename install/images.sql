CREATE TABLE
            images(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            description VARCHAR(255),
            file_name VARCHAR(255) NOT NULL UNIQUE,
            width INT(255),
            height INT(255)
            );
ROLLBACK;                

describe images;

select * from images;

drop table images;


