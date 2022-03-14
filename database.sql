
create table if not exists organisers(
    id int auto_increment primary key not null ,
    name varchar (100) not null ,
    email varchar (255) unique key not null,
    phone varchar(12) unique key not null,
    password varchar(255) not null
);


create table if not exists events(
    id int auto_increment primary key not null ,
    name varchar(100) not null ,
    description text not null ,
    date_time datetime not null ,
    category enum('Sport', 'Culture', 'Other') not null ,
    place varchar(100) not null ,
    picture varchar(255) not null ,
    interest_rating int not null ,
    organiser int not null,
    foreign key (organiser) references organisers(id)
);






select events.*, organisers.name as organiser_name from events inner join organisers on events.organiser = organisers.id where events.organiser = 1;
