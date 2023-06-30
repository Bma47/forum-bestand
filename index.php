<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>

<?php




$topic = $conn->query("SELECT topic.id AS id, topic.title AS title, topic.category AS category,
 topic.user_name AS user_name, topic.user_image AS user_image, topic.created_at AS created_at,
  COUNT(replies.topic_id) AS count_replies FROM topic LEFT JOIN replies ON topic.id = replies.topic_id GROUP BY(replies.topic_id)");

$topic->execute();
$allTopics = $topic->fetchAll(PDO::FETCH_OBJ);



?>
    <div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="main-col">
					<div class="block">
						<h1 class="pull-left">Welcome to Forum</h1>
						<h4 class="pull-right">A Simple Forum</h4>
						<div class="clearfix"></div>
						<hr>
						<ul id="topics">
	<?php foreach ($allTopics as $topic) : ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar pull-left" src="img/<?php echo $topic->user_image; ?>" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-right">
						<h3><a href="<?php echo APPURL; ?>/topic.php"><?php echo $topic->title; ?></a></h3>
							<div class="topic-info">
								<a href="<?php echo APPURL; ?>/category.php"><?php echo $topic->category; ?></a> >> <a href="<?php echo APPURL; ?>/profile.php"><?php echo $topic->user_name; ?></a> >> Posted on: <?php echo $topic->created_at; ?>
								<span class="color badge pull-right"><?php echo $topic->count_replies; ?></span>
							</div>
					</div>
				</div>
			</div>
		</li>
	<?php endforeach; ?>
</ul>

					</div>
				</div>
			</div>
		
			<?php include "includes/footer.php"; ?>
