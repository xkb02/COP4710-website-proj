CREATE TABLE PROPERTY (
    address VARCHAR(50) PRIMARY KEY,
    ownerName VARCHAR(30),
    price INTEGER
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
