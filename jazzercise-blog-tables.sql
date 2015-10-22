DROP TABLE IF EXISTS comment;
DROP TABLE IF EXISTS blogPost;

CREATE TABLE blogPost (
	blogPostId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	blogAuthor VARCHAR(128) NOT NULL,
	blogDate TIMESTAMP NOT NULL,
	blogPost VARCHAR(10000),
	blogTitle VARCHAR(128) NOT NULL,
	PRIMARY KEY (blogPostId)
);
CREATE TABLE comment (
	commentId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	blogPostId INT UNSIGNED NOT NULL,
	commentContent VARCHAR(2000) NOT NULL,
	commentDate TIMESTAMP NOT NULL,
	email VARCHAR(128) NOT NULL,
	name VARCHAR(128) NOT NULL,
	yourUrl VARCHAR(1024),
	INDEX(blogPostId),
	FOREIGN KEY(blogPostId) REFERENCES blogPost(blogPostId),
	PRIMARY KEY(commentId)
);
