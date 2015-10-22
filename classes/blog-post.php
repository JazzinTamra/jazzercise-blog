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
	 */
	private $blogPostId;
	/**
	 * author of this Blog Post; string $blogAuthor
	 * @var string $blogAuthor
	 */
	private $blogAuthor;
	/**
	 * date and time this Blog was poste, in a PHP DateTime object
	 * @var DateTime $blogDate
	 */
	private $blogDate;
	/**
	 * actual textual content of the Blog Post
	 * @var string $blogPost
	 */
	private $blogPost;
	/**
	 * title of this Blog Post
	 * @var string $blogTitle
	 */
	private $blogTitle;

	/**
	 * accessor method for Blog Post id
	 *
	 * @return mixed value of Blog Post id
	 */
	public function getBlogPostId() {
		return ($this->blogPostId);
	}

	/**
	 * mutator method for Blog Post id
	 *
	 * @pram mixed $newBlogPostId new value of blog post id
	 * @throws InvalidArgumentException if $newBlogPostId is not an integer
	 * @throws RangeException if $newBlogPostId is not positive
	 */
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
	 */
	public function getBlogAuthor() {
		return ($this->blogAuthor);
	}

	/**
	 * mutator method for blog author
	 *
	 * @pram string $newBlogAuthor new value of blog author
	 * @throws InvalidArgumentException if $newBlogAuthor is not a string or insecure
	 * @throws RangeException is $newBlogAuthor is > 128 characters
	 *
	 **/
	public function setBlogAuthor($newBlogAuthor) {
		//verity the blog author is secure
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
	 */
	public function getBlogDate() {
		return ($this->blogDate);
	}

	/**
	 * mutator method for blog date
	 *
	 * @param mixed $newBlogDate blog date as a DateTime object or string (or null to load the current time)
	 * @throws InvalidArgumentException if $newBlogDate is not a valid object or string
	 * @throws RangeException if $newBlogDate is a date that does not exist
	 * @throws Exception if some other exception is thrown
	 **/
	public function setBlogDate($newBlogDate) {
		//base case: if the date is null leave as null for MySQL to fill.
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
	 */
	public function getBlogPost() {
		return ($this->blogPost);
	}

	/**
	 * mutator method for blog post
	 *
	 * @pram string $newBlogPost new value of blog post
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
	 */
	public function getBlogTitle() {
		return ($this->blogTitle);
	}

	/**
	 * mutator method for blog title
	 *
	 * @pram string $newBlogTitle new value of blog title
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
}