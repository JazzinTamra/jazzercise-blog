<?php

/**
 * Blog Post Section of a Jazzericise.com
 *
 * This Blog Post can be considered a small example of what a web page like Jazzercise.com would store when
 * a Post is made on their site.
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 **/
class BlogPost {
	/**
	 * id of this Blog Post; this is the primary key
	 * @var int $blogPostId
	 **/
	private $blogPostId;
	/**
	 * author of this Blog Post; string $blogAuthor
	 * @var string $blogAuthor
	 **/
	private $blogAuthor;
	/**
	 * date and time this Blog was posted, in a PHP DateTime object
	 * @var DateTime $blogDate
	 **/
	private $blogDate;
	/**
	 * actual textual content of the Blog Post
	 * @var string $blogPost
	 **/
	private $blogPost;
	/**
	 * title of this Blog Post
	 * @var string $blogTitle
	 **/
	private $blogTitle;

	/**
	 * constructor for this blog post
	 *
	 * @param mixed $newBlogPostId new value of blog post id
	 * @param mixed $newBlogDate blog date as a DateTime object or string or null MySQL loads TIMESTAMP "now"
	 * @param string $newBlogPost new value of blog post
	 * @param string $newBlogTitle new value of blog title
	 * @param string $newBlogAuthor new value of blog author or null is omitted
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException if data values are not out of bounds (e.g., strings too long, negative integers)
	 * @throws Exception if some other exception is thrown
	 */
	public function __construct($newBlogPostId, $newBlogDate, $newBlogPost, $newBlogTitle, $newBlogAuthor = null) {
		try {
			$this->setBlogPostId($newBlogPostId);
			$this->setBlogAuthor($newBlogAuthor);
			$this->setBlogDate($newBlogDate);
			$this->setBlogPost($newBlogPost);
			$this->setBlogTitle($newBlogTitle);
		} catch(InvalidArgumentException $invalidArgument) {
			//rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			//rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			//rethrow a general exception
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for Blog Post id
	 *
	 * @return mixed value of Blog Post id
	 **/
	public function getBlogPostId() {
		return ($this->blogPostId);
	}

	/**
	 * mutator method for Blog Post id
	 *
	 * @param mixed $newBlogPostId new value of blog post id
	 * @throws InvalidArgumentException if $newBlogPostId is not an integer
	 * @throws RangeException if $newBlogPostId is not positive
	 **/
	public function setBlogPostId($newBlogPostId) {
		// base case: if the blog post id is null, this a new blog post without a mySQL assigned id (yet)
		if($newBlogPostId === null) {
			$this->blogPostId = null;
			return;
		}
		//verify the blog post id is valid
		$newBlogPostId = filter_var($newBlogPostId, FILTER_VALIDATE_INT);
		if($newBlogPostId === false) {
			throw(new InvalidArgumentException("blog post id is not a valid integer"));
		}
		// verify the blog post id is positive
		if($newBlogPostId <= 0) {
			throw(new RangeException("blog post id is not positive"));
		}
		// convert and store the blog post id
		$this->blogPostId = intval($newBlogPostId);
	}

	/**
	 * accessor method for blog author
	 *
	 * @return string value of blog author
	 **/
	public function getBlogAuthor() {
		return ($this->blogAuthor);
	}

	/**
	 * mutator method for blog author
	 *
	 * @param string $newBlogAuthor new value of blog author
	 * @throws RangeException is $newBlogAuthor is > 128 characters
	 *
	 **/
	public function setBlogAuthor($newBlogAuthor) {
		//verity the blog author is secure returns null if insecure
		$newBlogAuthor = trim($newBlogAuthor);
		$newBlogAuthor = filter_var($newBlogAuthor, FILTER_SANITIZE_STRING);


		//verify that the blog author will fit in the database
		if(strlen($newBlogAuthor) > 128) {
			throw(new InvalidArgumentException("blog author is too long"));
		}

		//store the blog author
		$this->newBlogAuthor = $newBlogAuthor;
	}

	/**
	 * accessor method for blogDate
	 *
	 * @return DateTime value of blogDate
	 **/
	public function getBlogDate() {
		return ($this->blogDate);
	}

	/**
	 * mutator method for blog date
	 *
	 * @param mixed $newBlogDate blog date as a DateTime object or string or null MySQL loads TIMESTAMP "now"
	 * @throws InvalidArgumentException if $newBlogDate is not a valid object or string
	 * @throws RangeException if $newBlogDate is a date that does not exist
	 * @throws Exception if some other exception is thrown
	 **/
	public function setBlogDate($newBlogDate) {
		//base case: if the date is null MySQL fills with now to fill.
		if($newBlogDate === null) {
			$this->blogDate = new DateTime("now");
			return;
		}

		// store the blog date
		try {
			$newBlogDate = validateDate($newBlogDate);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
		$this->blogDate = $newBlogDate;
	}

	/**
	 * accessor method for blog post
	 *
	 * @return string value of blog post
	 **/
	public function getBlogPost() {
		return ($this->blogPost);
	}

	/**
	 * mutator method for blog post
	 *
	 * @param string $newBlogPost new value of blog post
	 * @throws InvalidArgumentException if $newBlogPost is not a string or insecure
	 * @throws RangeException is $newBlogPost is > 10000 characters
	 *
	 **/
	public function setBlogPost($newBlogPost) {
		//verity the blog post is secure
		$newBlogPost = trim($newBlogPost);
		$newBlogPost = filter_var($newBlogPost, FILTER_SANITIZE_STRING);
		if(empty($newBlogPost) === true) {
			throw(new InvalidArgumentException("blog post is empty or insecure"));
		}

		//verify that the blog post will fit in the database
		if(strlen($newBlogPost) > 10000) {
			throw(new InvalidArgumentException("blog post is too long"));
		}

		//store the blog post
		$this->newBlogPost = $newBlogPost;
	}

	/**
	 * accessor method for blog title
	 *
	 * @return string value of blog title
	 **/
	public function getBlogTitle() {
		return ($this->blogTitle);
	}

	/**
	 * mutator method for blog title
	 *
	 * @param string $newBlogTitle new value of blog title
	 * @throws InvalidArgumentException if $newBlogTitle is not a string or insecure
	 * @throws RangeException is $newBlogTitle is > 128 characters
	 *
	 **/
	public function setBlogTitle($newBlogTitle) {
		//verity the blog title is secure
		$newBlogTitle = trim($newBlogTitle);
		$newBlogTitle = filter_var($newBlogTitle, FILTER_SANITIZE_STRING);
		if(empty($newBlogTitle) === true) {
			throw(new InvalidArgumentException("blog title is empty or insecure"));
		}

		//verify that the blog title will fit in the database
		if(strlen($newBlogTitle) > 128) {
			throw(new InvalidArgumentException("blog title is too long"));
		}

		//store the blog title
		$this->newBlogTitle = $newBlogTitle;
	}

	/**
	 * insert this Blog Post into mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function insert(PDO $pdo) {
		//enforce the blogPostId is null (i.e., don't insert a blog post that already exists)
		if($this->blogPostId !== null) {
			throw(new PDOException("not a new blog post"));
		}
		// create query template
		$query = "INSERT INTO blogPost(blogDate, blogPost, blogTitle, blogAuthor) VALUES(:blogDate, :blogPost, :blogTitle, :blogAuthor)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->blogDate->format("Y-m-d H:i:s");
		$parameters = array("blogDate" => $formattedDate, "blogPost" => $this->blogPost, "blogTitle" => $this->blogTitle, "blogAuthor" => $this->blogAuthor);
		$statement->execute($parameters);

		//update the null blogPostId with what mySQL just gave us
		$this->blogPostId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this blogPost from mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 */
	public function delete(PDO $pdo) {
		//enforce the blogPostId is not null (i.e., don't delete a blog post that hasn't been inserted)
		if($this->blogPostId === null) {
			throw(new PODException("unable to delete a blog post that does not exist"));
		}

		//create query template
		$query = "DELETE FROM blogPost WHERE blogPostId = :blogPostId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = array("blogPostId" => $this->blogPostId);
		$statement->execute($parameters);
	}

	/**
	 * updates this blog post in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 */
	public function update(PDO $pdo) {
		//enforce the blogPostId is not null (i.e., don't update a blog post that hasn't been inserted)
		if($this->blogPostId === null) {
			throw(new PDOException("unable to update a blog post that does note exist"));
		}

		//create a query template QUESTION: why does this line not need VALUES(:blogDate, :blogPost, :blogTitle, :blogAuthor like insert above?
		$query = "UPDATE blogPost SET blogDate  = :blogDate, blogPost = :blogPost, blogTitle = :blogTitle, blogAuthor = :blogAuthor WHERE blogPostId = :blogPostId";
		$statement = $pdo->($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->blogDate->format("Y-m-d H:i:s");
		$parameters = array("blogDate" => $formattedDate, "blogPost" => $this->blogPost, "blogTitle" => $this->blogTitle,
			"blogAuthor" => $this->blogAuthor, "blogPostId" => $this->blogPostId);
		$statement->execute($parameters);
	}

	/**
	 * gets the Blog Post by content
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param string $blogPost blog post content to search for
	 * @return splFixedArray all blog posts found for this content
	 * @throws PDOException when mySQL related errors occur
	 * QUESTION: Why won't PHP Storm remember the $pdo pointer? It wants to make it $PDO
	 * QUESTION: Is there rhyme or reason to when a space is needed and when it is not?
	 **/
	public static function getBlogPostContent(PDO $pdo, $blogPost) {
		// sanitize the description before searching
		$blogPost = trim($blogPost);
		$blogPost = filter_var($blogPost, FILTER_SANITIZE_STRING);
		if(empty($blogPost) === true) {
			throw(new PDOException("blog post content is invalid"));
		}

		//create a query template
		$query = "SELECT blogPostId, blogDate, blogPost, blogTitle, blogAuthor FROM blogPost WHERE blogPost LIKE :blogPost";
		$statement = $pdo->prepare($query);

		//bind the blog post to the place holder in the template
		$blogPost = "%$blogPost%";
		$parameters = array("blogPost" => $blogPost);
		$statement->execute($parameters);

		// build an array of blog posts
		$blogPosts = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$blogPost = new BlogPost($row["blogPostId"], $row["blogDate"], $row["blogPost"], $row["blogTitile"], $row["blogAuthor"]);
				$blogPosts[$blogPost->key()] = $blogPost;
				$blogPosts->next();
			} catch(Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($blogPosts);
	}
}