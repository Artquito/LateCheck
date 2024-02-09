CREATE TABLE Classes (
    classId INT(100) NOT NULL AUTO_INCREMENT,
    className VARCHAR(255) NOT NULL,

    PRIMARY KEY (classId)
);

CREATE TABLE Accounts (
    accountId INT(100) NOT NULL AUTO_INCREMENT,
    accountType VARCHAR(100) NOT NULL,
    accountPassword VARCHAR (100) NOT NULL,

    PRIMARY KEY (accountId)
);

CREATE TABLE Users (
    userId INT (100) NOT NULL AUTO_INCREMENT,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255),
    birthDay DATE NOT NULL,
    userType VARCHAR(50) NOT NULL,
    classId INT (100),
    accountId INT(100),

    PRIMARY KEY (userId),
    FOREIGN KEY (classId) REFERENCES Classes(classId),
    FOREIGN KEY (accountId) REFERENCES Accounts(accountId)
);

CREATE TABLE LateTickets (
    ticketID INT(100) NOT NULL AUTO_INCREMENT,
    ticketDate DATETIME NOT NULL,
    reason VARCHAR(100) NOT NULL,
    studentGrade VARCHAR(100) NOT NULL,
    userId INT (100) NOT NULL,

    PRIMARY KEY (ticketID),
    FOREIGN KEY (userId) REFERENCES Users(userId) 
);

