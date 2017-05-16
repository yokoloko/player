begin;

create table user (id SERIAL PRIMARY KEY, email TEXT NOT NULL, firstname TEXT NOT NULL, lastname TEXT NOT NULL, date_created TIMESTAMP NOT NULL DEFAULT NOW());

ALTER TABLE user ADD CONSTRAINT user_unique_email UNIQUE (email(100));

insert into user (email, firstname, lastname) values ('jeremie@gmail.com', 'Jeremie', 'Thomassey');
insert into user (email, firstname, lastname) values ('leSid@gmail.com', 'Sidney', 'Govou');
insert into user (email, firstname, lastname) values ('sonny@gmail.com', 'Sonny', 'Anderson');

create table song (id SERIAL PRIMARY KEY, name TEXT NOT NULL, duration INTEGER NOT NULL, date_created TIMESTAMP NOT NULL DEFAULT NOW());
insert into song (name, duration) VALUES ('Handlebars', 180);
insert into song (name, duration) VALUES ('Charognards', 230);
insert into song (name, duration) VALUES ('Love yourself', 120);

create table favorite (id SERIAL PRIMARY KEY, user_id INTEGER REFERENCES user(id), song_id INTEGER REFERENCES song(id), date_created TIMESTAMP NOT NULL DEFAULT NOW());

ALTER TABLE favorite ADD CONSTRAINT user_unique_email UNIQUE (user_id, song_id);

insert into favorite (user_id, song_id) VALUES (1, 1);
insert into favorite (user_id, song_id) VALUES (1, 2);
insert into favorite (user_id, song_id) VALUES (2, 3);

COMMIT ;