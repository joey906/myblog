create table Blogdata(
    id int NOT NULL AUTO_INCREMENT,
    title Varchar(191),
    content text,
    category int,
    post_at timestamp,
    published_status int default 1,
    primary key (id)
);