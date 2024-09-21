CREATE TABLE iciprefix_user (
    id SERIAL,
    login VARCHAR(16),
    password VARCHAR(255),
    email VARCHAR(320) UNIQUE,
    role smallint,
    status smallint,
    is_deleted smallint,
    password_key VARCHAR(45),
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE iciprefix_page (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    type smallint,
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE iciprefix_review (
    id SERIAL PRIMARY KEY,
    userName VARCHAR(255),
    content VARCHAR(255),
    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    approved smallint,
    user_id integer,
    FOREIGN KEY (user_id) REFERENCES iciprefix_user(id)
);

CREATE TABLE iciprefix_passwordReset (
    id SERIAL,
    email VARCHAR(250) NOT NULL,
    key VARCHAR(250) NOT NULL,
    exp_date date NOT NULL,
    PRIMARY KEY (id)
);