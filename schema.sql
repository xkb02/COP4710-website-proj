DROP DATABASE IF EXISTS RealEst;
CREATE DATABASE RealEst;
USE RealEst;

CREATE TABLE PROPERTY (
    address VARCHAR(50) PRIMARY KEY,
    ownerName VARCHAR(30) NOT NULL,
    price INTEGER NOT NULL
);

CREATE TABLE HOUSE (
    bedrooms INTEGER,
    bathrooms INTEGER,
    size INTEGER,
    address VARCHAR(50) PRIMARY KEY,
    FOREIGN KEY (address) REFERENCES PROPERTY(address)
);

CREATE TABLE BUSINESS_PROPERTY (
    type CHAR(20),
    size INTEGER,
    address VARCHAR(50) PRIMARY KEY,
    FOREIGN KEY (address) REFERENCES PROPERTY(address)
);

CREATE TABLE FIRM (
    id INTEGER PRIMARY KEY,
    name VARCHAR(30),
    address VARCHAR(50)
);

CREATE TABLE AGENT (
    agentId INTEGER PRIMARY KEY,
    name VARCHAR(30),
    phone CHAR(12),
    firmId INTEGER,
    dateStarted DATE,
    FOREIGN KEY (firmId) REFERENCES FIRM(id)
);

CREATE TABLE LISTINGS (
    mlsNumber INTEGER PRIMARY KEY,
    address VARCHAR(50) UNIQUE,
    agentId INTEGER,
    dateListed DATE,
    FOREIGN KEY (address) REFERENCES PROPERTY(address),
    FOREIGN KEY (agentId) REFERENCES AGENT(agentId)
);

CREATE TABLE BUYER (
    id INTEGER PRIMARY KEY,
    name VARCHAR(30),
    phone CHAR(12),
    propertyType CHAR(20),
    bedrooms INTEGER,
    bathrooms INTEGER,
    businessPropertyType CHAR(20),
    minimumPreferredPrice INTEGER,
    maximumPreferredPrice INTEGER
);

CREATE TABLE WORKS_WITH (
    buyerId INTEGER,
    agentId INTEGER,
    PRIMARY KEY (buyerId, agentId),
    FOREIGN KEY (buyerId) REFERENCES BUYER(id),
    FOREIGN KEY (agentId) REFERENCES AGENT(agentId)
);

INSERT INTO PROPERTY (address, ownerName, price) VALUES
    ('123 Maple St', 'John Doe', 250000),
    ('456 Oak St', 'Jane Smith', 150000),
    ('789 Pine St', 'Tom Brown', 200000),
    ('321 Elm St', 'Mary White', 400000),
    ('654 Cedar St', 'Alice Green', 500000),
    ('100 Main St','James Johnson',1000000),
    ('200 7th Ave','Guy Normal',100000),
    ('5000 Office Blvd','Geoff Pesos',2000000),
    ('15 Enterprise Rd','Alan Alexander',350000),
    ('930 N Government Dr','Steph Works',900000),
    ('111 Lake Ave', 'Sarah Wilson', 180000),
    ('222 River Rd', 'Mike Johnson', 220000),
    ('333 Forest Ln', 'Emma Davis', 195000);

INSERT INTO HOUSE (bedrooms, bathrooms, size, address) VALUES
    (4,2,3300,'123 Maple St'),
    (3,2,1000,'456 Oak St'),
    (3,2,2500,'789 Pine St'),
    (5,3,4500,'321 Elm St'),
    (6,4,6000,'654 Cedar St'),
    (3,2,1800,'111 Lake Ave'),
    (3,2,2200,'222 River Rd'),
    (4,2,2800,'333 Forest Ln');

INSERT INTO BUSINESS_PROPERTY (type, size, address) VALUES
    ('Gas Station', 20000, '100 Main St'),
    ('Office Space',1000,'200 7th Ave'),
    ('Office Space', 30000,'5000 Office Blvd'),
    ('Office Space',5000,'15 Enterprise Rd'),
    ('Govt. Building',7500,'930 N Government Dr');

INSERT INTO Firm (id, name, address) VALUES
    (1, 'Best Realty', '1 Agency Blvd'),
    (2, 'Sunshine Properties', '2 Sunshine Lane'),
    (3, 'Elite Homes', '3 Prestige Avenue'),
    (4, 'Urban Realty', '4 Downtown St'),
    (5, 'Luxury Estates', '5 High-End Way');

INSERT INTO AGENT (agentId, name, phone, firmId, dateStarted) VALUES
    (1, 'Agent A', '123-456-7890', 1, '2024-01-01'),
    (2, 'Agent B', '234-567-8901', 2, '2023-06-15'),
    (3, 'Agent C', '345-678-9012', 3, '2022-08-10'),
    (4, 'Agent D', '456-789-0123', 4, '2021-03-20'),
    (5, 'Agent E', '567-890-1234', 5, '2020-12-01');

INSERT INTO LISTINGS (mlsNumber, address, agentId, dateListed) VALUES
    (1,'123 Maple St', 5,'2023-02-02'),
    (2,'321 Elm St',3, '2024-11-11'),
    (3,'5000 Office Blvd',1,'2020-04-20'),
    (4,'15 Enterprise Rd',2,'2021-10-31'),
    (5,'100 Main St',4,'2024-08-25'),
    (6,'456 Oak St', 1,'2024-01-15'),
    (7,'789 Pine St', 2,'2024-02-01'),
    (8,'111 Lake Ave', 3,'2024-01-20'),
    (9,'222 River Rd', 4,'2024-02-15'),
    (10,'333 Forest Ln', 5,'2024-03-01');

INSERT INTO Buyer (id, name, phone, propertyType, bedrooms, bathrooms, businessPropertyType, minimumPreferredPrice, maximumPreferredPrice) VALUES
    (1, 'John Smith', '111-111-1111', 'House', 3, 2, NULL, 100000, 300000),
    (2, 'Jane Doe', '222-222-2222', 'House', 4, 2, NULL, 200000, 400000),
    (3, 'Tom Johnson', '333-333-3333', 'Business', NULL, NULL, 'Office Space', 300000, 500000),
    (4, 'Alice White', '444-444-4444', 'Business', NULL, NULL, 'Govt. Building', 800000, 1200000),
    (5, 'Bob Brown', '555-555-5555', 'House', 5, 3, NULL, 350000, 600000);

INSERT INTO Works_With (buyerId, agentId) VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (1, 2),
    (2, 3),
    (3, 4);
