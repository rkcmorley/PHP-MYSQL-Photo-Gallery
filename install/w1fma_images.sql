-- This creates the table for the images
CREATE TABLE
            images(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            description VARCHAR(255),
            file_name VARCHAR(255) NOT NULL,
            width INT(255),
            height INT(255)
            );
                
-- This views the entire table, images
select * from images;

-- This removes the table, images
drop table images;


