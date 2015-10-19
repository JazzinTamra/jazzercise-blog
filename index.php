<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8"/>
		<!-- css -->
		<link href="css/style.css" rel="stylesheet">
		<!-- Google Fonts -->
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700|Oswald:400,300,700" rel="stylesheet" type="text/css">
		<title>Jazzercise Blog Persona & Use Case</title>
	</head>
	<body>
		<header>
			<img class="openlogo" src="img/logo.png"/>
			<hr/>
			<h1 class="blogtitle">Jazzercise Blog Persona</h1></header>
		<main>
			<img class="rebecca" src="img/rebecca-19yrs.jpg" alt="Picture of Rebecca">
			<h2>Rebecca</h2>
			<p>Rebecca is a young woman age 19. She&rsquo;s a is health conscience college student, and uses exercise to relieve stress. She has a crazy busy life filled with with school and a part-time job. She makes time for Jazzercise because she likes the hard workouts that keep her fit and looking good. Rebecca finds herself using the Jazzercise.com website on her Android phone with Kitkat daily when she plans her workout. Rebecca knows her way around the web, the Google Drive and social media, but is not especially technical. She won't be jail breaking her phone anytime soon. She attends classes at different times at different centers all over town, just so she can fit a workout in. She likes knowing what format to expect and what instructor will be teaching the class. Rebecca sees the blog topics on the Jazzercise home page when she visits the site, and clicks through to read when the topics are of interest. See uses the tips and sometime talks with her friend before class about the topics she reads about.</p>
			<h2>Use Case for Rebecca</h2>
			<p>GOAL: For Rebecca to browse Jazzercise.com blog posts.</p>
			<p>Rebecca is checking out the possible class times for tomorrow&rsquo;s workout and sees the blog titled &ldquo;Hairstyles for Hitting the Gym.&rdquo; She immediately clicks through since she is growing out her bangs and is finding alternatives to her current hairstyle. None of the pictures seem like options, but Monica has posted an idea in the comments that she just might try tomorrow.</p>
			<p>Step for the use case: </p>
			<ul>
				<li>Action: Open browser and navigate to Jazzercise.com</li>
				<li>Response: Home page loads</li>
				<li>Action: Scrolls down and reads blog post topics</li>
				<li>Action: Clicks VIEW ALL </li>
				<li>Response: Loads www.jazzercise.com/Community/Blog</li>
				<li>Action: Scrolls down to &ldquo;Hairstyles for Hitting the Gym&rdquo; Clicks READ MORE</li>
				<li>Response: Loads http://www.jazzercise.com/Community/Blog/September-2015/Hairstyles-for-Hitting-the-Gym</li>
			</ul>
			<img class="figure" src="img/jazzercise-blog-mrd.svg" alt="Jazzercise Blog Entity Relationship Diagram"/>
		<h3>Blog Post Entity</h3>
		<p>The Blog Post entity has a one to many relationship with comments.</p>
		<h4>Attributes include:</h4>
		<ul>
			<li>Date</li>
			<li>Title</li>
			<li>Author</li>
			<li>Blog content: text and images</li>
			<li>blogPostId</li>
		</ul>
		<h3>Comments Entity</h3>
		<p>The Comments entity has a many to one relationship with a blog post.</p>
		<h4>Attributes include:</h4>
		<ul>
			<li>Name</li>
			<li>Email</li>
			<li>Your URL</li>
			<li>Comments content</li>
			<li>blogPostId</li>
			<li>commentId</li>
		</ul>
		<img class="figure" src="img/jazzercise-blog-mrd.png" alt="Jazzercise Blog Entity Relationship Diagram"/>
			<img class="figure" src="img/jazzercise-blog-mrd.svg" alt="Jazzercise Blog Entity Relationship Diagram"/>
		</main>
	</body>
</html>
