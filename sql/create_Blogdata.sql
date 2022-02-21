create table Blogdata(
    id int NOT NULL AUTO_INCREMENT,
    title Varchar(191),
    content text,
    category int,
    post_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    published_status int default 1,
    primary key (id)
);