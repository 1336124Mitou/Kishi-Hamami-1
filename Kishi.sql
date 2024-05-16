-- utf8を設定;
set names utf8;
-- データベースが存在してるなら削除する
DROP database if EXISTS kishi;
-- データベースkishiの作成
CREATE DATABASE if NOT EXISTS kishi CHARACTER set utf8 COLLATE utf8_general_ci;

-- ユーザーKishiに、パスワードhamamiを設定し、データベースkishiに対するすべての権限を付与
grant all PRIVILEGES on kishi.* to Kishi@localhost identified by 'hamami';

-- kishiデータベースを選択
use kishi;

-- ユーザーのテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Usr;

-- テーブルUsrの作成
CREATE TABLE Usr (
    UsID VARCHAR(50) PRIMARY KEY,
    UsName VARCHAR(255) UNIQUE NOT NULL,
    Passw VARCHAR(255) NOT NULL,
    Prof TEXT NOT NULL,
    ProfPic BLOB
);

INSERT INTO Usr(UsID, UsName, Passw, prof) values('kd1@gmail.com', 'testuser', 'aaa', 'aaa');

-- タグのテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Tags;

-- テーブルTagsの作成
CREATE TABLE Tags (
    TagID INT PRIMARY KEY AUTO_INCREMENT,
    TagName VARCHAR(30) UNIQUE
);

INSERT INTO Tags(TagName) VALUES ('C#');
INSERT INTO Tags(TagName) VALUES ('C++');
INSERT INTO Tags(TagName) VALUES ('Python');
INSERT INTO Tags(TagName) VALUES ('Java');
INSERT INTO Tags(TagName) VALUES ('JavaScript');
INSERT INTO Tags(TagName) VALUES ('Linux');
INSERT INTO Tags(TagName) VALUES ('SQL');
INSERT INTO Tags(TagName) VALUES ('HTML');
INSERT INTO Tags(TagName) VALUES ('Ruby');

-- 質問のテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Question;

-- テーブルQuestionの作成
CREATE TABLE Question (
    QuestionID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    D DATE NOT NULL,
    Tim TIME NOT NULL,
    Question TEXT NOT NULL,
    UsID VARCHAR(50) NOT NULL,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID)
);

INSERT INTO Question(D, Tim, Question, UsID) VALUES ('2023-12-09', '12:02:00', 'C#のフォームの表示のやり方に関する質問', 'kd1@gmail.com');

-- 質問のIDとタグIDを関連するテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS QuestionTags;

-- テーブルQuestionTagsの作成
CREATE TABLE QuestionTags (
    QuestionID INT NOT NULL,
    TagID INT NOT NULL,
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (TagID) REFERENCES Tags(TagID),
    PRIMARY KEY (QuestionID, TagID)
);

INSERT INTO QuestionTags(QuestionID, TagID) VALUES (1, 1);

-- 回答のテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Reply;

-- テーブルReplyの作成
CREATE TABLE Reply (
    RepID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Reply TEXT NOT NULL,
    LNum INT NOT NULL DEFAULT 0,
    D DATE NOT NULL,
    Tim TIME NOT NULL
);

-- 質問のIDと回答のIDを関連するテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS RepQ;

-- テーブルRepQの作成
CREATE TABLE RepQ (
    RepID INT NOT NULL,
    QuestionID INT NOT NULL,
    FOREIGN KEY (RepID) REFERENCES Reply(RepID),
    FOREIGN Key (QuestionID) REFERENCES Question(QuestionID),
    PRIMARY KEY (RepID, QuestionID)
);

-- 記事のテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Report;

-- テーブルReportの作成
CREATE TABLE Report (
    RepoID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    Info TEXT DEFAULT NULL,
    Title VARCHAR(255) NOT NULL,
    LNum VARCHAR(255) DEFAULT 0,
    D DATE NOT NULL,
    Tim TIME NOT NULL
);

INSERT INTO Report(Title, Info, D, Tim) VALUES ('C#の新しいフォームの作り方', 'テンプレート記事のために、具体的な内容を後で書くことにしました。:P', '2022-10-31', '13:13:00');

-- 記事のIDとタグのIDを関連するテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS RepoTags;

-- テーブルRepoTagsの作成
CREATE TABLE RepoTags (
    RepoID INT NOT NULL,
    TagID INT NOT NULL,
    FOREIGN KEY (RepoID) REFERENCES Report(RepoID),
    FOREIGN KEY (TagID) REFERENCES Tags(TagID),
    PRIMARY KEY (RepoID, TagID)
);

INSERT INTO RepoTags(RepoID, TagID) VALUES(1, 1);

-- 記事のIDと質問のIDを関連するテーブル
-- テーブルがあるなら削除
DROP TABLE if EXISTS RepR;

-- テーブルRepRの作成
CREATE TABLE RepR (
    RepoID INT NOT NULL,
    RepID INT NOT NULL,
    FOREIGN KEY (RepoID) REFERENCES Report(RepoID),
    FOREIGN KEY (RepID) REFERENCES Reply(RepID),
    PRIMARY KEY (RepoID, RepID)
);

-- 制作物のテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Project;

-- テーブルProjectの作成
CREATE TABLE Project (
    ProID INT PRIMARY KEY AUTO_INCREMENT,
    ProName VARCHAR(255) NOT NULL,
    ProjFile LONGBLOB NOT NULL,
    Proexample VARCHAR(255) NOT NULL
);

-- 制作物のIDとタグのIDを関連するテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS ProjTags;

-- テーブルProjTagsの作成
CREATE TABLE ProjTags (
    ProID INT NOT NULL,
    TagID INT NOT NULL,
    FOREIGN KEY (ProID) REFERENCES Project(ProID),
    FOREIGN KEY (TagID) REFERENCES Tags(TagID),
    PRIMARY KEY (ProID, TagID)
);

-- いいねのテーブル
-- tableがあるなら削除
DROP TABLE if EXISTS Likes;

-- テーブルlikesの作成
CREATE TABLE Likes (
    LikeID INT PRIMARY KEY AUTO_INCREMENT,
    UsID VARCHAR(50) NOT NULL,
    RepID INT DEFAULT NULL,
    RepoID INT DEFAULT NULL,
    LikedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID),
    FOREIGN KEY (RepID) REFERENCES Reply(RepID),
    FOREIGN KEY (RepoID) REFERENCES Report(RepoID),
    UNIQUE KEY unique_like (UsID, RepID),
    UNIQUE KEY unique_repo_like (UsID, RepoID)
);

-- ユーザーと関連する記事データのリンクを保持するテーブル
-- テーブルがあるから削除
DROP TABLE IF EXISTS URlink;

-- URlinkのテーブルを作成する
CREATE TABLE URlink (   
    UsID VARCHAR(50) NOT NULL,
    RepoID INT DEFAULT NULL,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID),
    FOREIGN KEY (RepoID) REFERENCES Report(RepoID),
    PRIMARY KEY (UsID, RepoID)
);

-- ユーザーと関連する制作物データのリンクを保持するテーブル
-- テーブルがあるから削除
DROP TABLE IF EXISTS UPlink;

-- UPlinkのテーブルを作成する
CREATE TABLE UPlink (   
    UsID VARCHAR(50) NOT NULL,
    ProID INT DEFAULT NULL,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID),
    FOREIGN KEY (ProID) REFERENCES Project(ProID),
    PRIMARY KEY (UsID, ProID)
);

-- ユーザーと関連する回答データのリンクを保持するテーブル
-- テーブルがあるから削除
DROP TABLE IF EXISTS URelink;

-- URelinkのテーブルを作成する
CREATE TABLE URelink (   
    UsID VARCHAR(50) NOT NULL,
    RepID INT DEFAULT NULL,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID),
    FOREIGN KEY (RepID) REFERENCES Reply(RepID),
    PRIMARY KEY (UsID, RepID)
);

-- ユーザーと関連する質問データのリンクを保持するテーブル
-- テーブルがあるから削除
DROP TABLE IF EXISTS UQlink;

-- UQlinkのテーブルを作成する
CREATE TABLE UQlink (   
    UsID VARCHAR(50) NOT NULL,
    QuestionID INT DEFAULT NULL,
    FOREIGN KEY (UsID) REFERENCES Usr(UsID),
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    PRIMARY KEY (UsID, QuestionID)
);