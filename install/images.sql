describe images;

select file_name from images;

select 
        id as id,
        file_name as file,
        title as title,
        description as description,
        height as height,
        width as width
        from
        images
        where id = 1;

select width from images;

select * from images;

drop table images;

delete from images
where file_name = '72477621_10158273991998538_8909448303049965568_n.jpg';

CREATE TABLE 
            images(
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(255),
            description VARCHAR(255),
            file_name VARCHAR(255) NOT NULL UNIQUE,
            width INT(255),
            height INT(255)
            );
            
