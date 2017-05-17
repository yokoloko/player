create table user (
    id INTEGER AUTO_INCREMENT PRIMARY KEY
  , email TEXT NOT NULL
  , firstname TEXT NOT NULL
  , lastname TEXT NOT NULL
  , date_created TIMESTAMP NOT NULL DEFAULT NOW()
);

ALTER TABLE user ADD CONSTRAINT user_unique_email UNIQUE (email(100));

insert into user (email, firstname, lastname) values ('jeremie@gmail.com', 'Jeremie', 'Thomassey');
insert into user (email, firstname, lastname) values ('leSid@gmail.com', 'Sidney', 'Govou');
insert into user (email, firstname, lastname) values ('sonny@gmail.com', 'Sonny', 'Anderson');

create table song (
    id INTEGER AUTO_INCREMENT PRIMARY KEY
  , name TEXT NOT NULL, duration INTEGER NOT NULL
  , date_created TIMESTAMP NOT NULL DEFAULT NOW()
);

insert into song (name, duration) VALUES ('Handlebars', 180);
insert into song (name, duration) VALUES ('Charognards', 230);
insert into song (name, duration) VALUES ('Love yourself', 120);

create table favorite (
    id INTEGER AUTO_INCREMENT PRIMARY KEY
  , user_id INTEGER NOT NULL
  , song_id INTEGER NOT NULL
  , date_created TIMESTAMP NOT NULL DEFAULT NOW()
  , FOREIGN KEY (user_id) REFERENCES user(id)
  , FOREIGN KEY (song_id) REFERENCES song(id)
);

ALTER TABLE favorite ADD CONSTRAINT user_unique_email UNIQUE (user_id, song_id);

insert into favorite (user_id, song_id) VALUES (1, 1);
insert into favorite (user_id, song_id) VALUES (1, 2);
insert into favorite (user_id, song_id) VALUES (2, 3);