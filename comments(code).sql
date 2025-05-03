CREATE TABLE comments (
    id INTEGER(11) NOT NULL,
    user_id INTEGER(11),
    book_id INTEGER(4) NOT NULL,
    comment VARCHAR(300) NOT NULL,
    public BOOLEAN NOT NULL,
    CONSTRAINT commentspk
        PRIMARY KEY (id),
    CONSTRAINT user_idfk
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE SET NULL
    	ON UPDATE CASCADE,
    CONSTRAINT book_idfk
        FOREIGN KEY (book_id)
        REFERENCES book_inventory(id)
        ON DELETE CASCADE
);