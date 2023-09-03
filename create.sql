
CREATE TABLE user(
    login varchar(80) primary key,
    nom varchar(80),
    prenom varchar(80),
    nbCapture integer,
    ban boolean
);
CREATE TABLE pokemon(
    id varchar(255) primary key,
    nom varchar(80),
    image varchar(80),
    type varchar(80),
    description varchar(255),
    numero INTEGER
);
CREATE TABLE capture(
    idPoke varchar(255),
    pseudoUser varchar(80),
    primary key(idPoke, pseudoUser),
    foreign key(idPoke) references pokemon(id),
    foreign key (pseudoUser) references user(login)
);
