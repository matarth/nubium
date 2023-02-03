DROP TABLE IF EXISTS vote;
DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS article;

CREATE TABLE user (
                      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      uuid VARCHAR(255) UNIQUE NOT NULL,
                      name VARCHAR(255) NOT NULL,
                      email VARCHAR(255) UNIQUE NOT NULL,
                      password VARCHAR(255) NOT NULL,
                      date_of_registration DATETIME
);

CREATE TABLE article (
                         id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                         uuid VARCHAR(255) UNIQUE NOT NULL,
                         perex TEXT NOT NULL,
                         text TEXT NOT NULL,
                         validSince DATETIME NOT NULL,
                         created DATETIME NOT NULL
);

CREATE TABLE vote (
                      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      user_id INT UNSIGNED,
                      article_id INT UNSIGNED,
                      plus TINYINT(1) NOT NULL,
                      FOREIGN KEY (user_id) REFERENCES user(id),
                      FOREIGN KEY (article_id) REFERENCES user(id)
);

# INDEXES
CREATE INDEX user_uuid_idx ON user (uuid);
CREATE INDEX article_uuid_idx ON article (uuid);
CREATE INDEX user_email_idx ON user (email);
CREATE UNIQUE INDEX vote_unique_idx ON vote (user_id, article_id);