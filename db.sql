create table task (
    id int auto_increment PRIMARY KEY,
    description varchar(255) not null,
    done boolean default false,
    added timestamp default current_timestamp
)