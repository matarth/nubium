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
                         created DATETIME NOT NULL,
                         public TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE vote (
                      id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                      user_id INT UNSIGNED,
                      article_id INT UNSIGNED,
                      score TINYINT NOT NULL DEFAULT 0,
                      FOREIGN KEY (user_id) REFERENCES user(id),
                      FOREIGN KEY (article_id) REFERENCES article(id)
);

# INDEXES
CREATE INDEX user_uuid_idx ON user (uuid);
CREATE INDEX article_uuid_idx ON article (uuid);
CREATE INDEX user_email_idx ON user (email);
CREATE UNIQUE INDEX vote_unique_idx ON vote (user_id, article_id);



INSERT INTO article (id, uuid, perex, text, validSince, created, public)
VALUES
    (1, 'uuid1', 'PPPperex1', 'text1', '2022-01-01', '2022-01-01', 1),
    (2, 'uuid2', 'PPPperex2', 'text2', '2022-01-02', '2022-01-02', 1),
    (3, 'uuid3', 'PPPperex3', 'text3', '2022-01-03', '2022-01-03', 1),
    (4, 'uuid4', 'PPPperex4', 'text4', '2022-01-04', '2022-01-04', 1),
    (5, 'uuid5', 'PPPperex5', 'text5', '2022-01-05', '2022-01-05', 1),
    (6, 'uuid6', 'PPPperex6', 'text6', '2022-01-06', '2022-01-06', 1),
    (7, 'uuid7', 'PPPperex7', 'text7', '2022-01-07', '2022-01-07', 1),
    (8, 'uuid8', 'PPPperex8', 'text8', '2022-01-08', '2022-01-08', 1),
    (9, 'uuid9', 'PPPperex9', 'text9', '2022-01-09', '2022-01-09', 1),
    (10, 'uuid10', 'PPPperex10', 'text10', '2022-01-10', '2022-01-10', 1),
    (11, 'uuid11', 'PPPperex11', 'text11', '2022-01-11', '2022-01-11', 1);


INSERT INTO user (id, uuid, name, email, password, date_of_registration) VALUES (1, 'c10c76ce17e59c4d304ba37e62d41da353afdd69', 'test', 'test@test.test', '$2y$12$1zb6pwz86Vs3nbA7sraKmOBLCaIe2UFEZtWTml9WrOrbT./aAAfe2', '2023-02-03 19:33:25');
INSERT INTO user (id, uuid, name, email, password, date_of_registration) VALUES (2, '1d17ae6ea0609e1061877a6ebd4dfcf01d5b5b23', 'test2', 'test2@test2.cz', '$2y$12$INIQ8xuQwNIgbsBF1npHuuuTTqZf3jlDHnEeZdHa5bGW1ofss/hhO', '2023-02-03 19:33:39');

INSERT INTO vote (id, user_id, article_id, score)
VALUES
    (1, 2,1,-1),
    (2, 2,2,1),
    (3, 2,3,1),
    (4, 1,3,-1),
    (5, 1,4,1);