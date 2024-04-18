-- utf8を設定;
set names utf8;
-- データベースが存在してるなら削除する
DROP database if EXISTS kishi;
-- データベースkishiの作成
CREATE DATABASE if NOT EXISTS kishi CHARACTER set utf8 COLLATE utf8_general_ci;

-- 許可を設定
GRANT ALL PRIVILEGES ON *.* to 'test'@'%';

-- kishiデータベースを選択
use kishi;

-- tableがあるなら削除
DROP TABLE if EXISTS Tags;

-- テーブルTagsの作成
CREATE TABLE Tags (
    TagID INT PRIMARY KEY auto_increment,
    TagName VARCHAR(30) UNIQUE
);

-- tableがあるなら削除
DROP TABLE if EXISTS Question;

-- テーブルQuestionの作成
CREATE TABLE Question (
    QuestionID INT NOT NULL auto_increment,
    Question TEXT NOT NULL
);

-- tableがあるなら削除
DROP TABLE if EXISTS QuestionTags;

-- テーブルQuestionTagsの作成
CREATE TABLE QuestionTags (
    QuestionID int,
    TagID int,
    FOREIGN KEY (QuestionID) REFERENCES Question(QuestionID),
    FOREIGN KEY (TagID) REFERENCES Tags(TagID),
    PRIMARY KEY (QuestionID, TagID)
);