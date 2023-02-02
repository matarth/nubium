DROP TABLE IF EXISTS user;
CREATE TABLE user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255),
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    last_online DATETIME,
    date_of_registration DATETIME
);


DROP TABLE IF EXISTS article;
CREATE TABLE article (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(255),
    perex TEXT,
    text TEXT,
    validSince DATETIME,
    created DATETIME
);


DROP TABLE IF EXISTS vote;
CREATE TABLE vote (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED,
    article_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (article_id) REFERENCES user(id)
);

# INDEXES
CREATE INDEX user_uuid_idx ON user (uuid);
CREATE INDEX user_email_idx ON user (email);