<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Create Article</title>
    </head>
    <body>
        <!--start of form-->
        <h2 class="text-center"></h2><br><br><br>
        <form class="text-center" id="createArticleForm" method="post" action="php/article.php">
            <label for="articleId">Article ID</label>
            <input type="text" id="articleId" name="articleId" /> <br><br>
            <label for="userId">User Id</label>
            <input type="text" id="userId" name="userId" /> <br><br>
            <label for="title">Title</label>
            <input type="title" id="title" name="title" /> <br><br>
            <label for="author">Author</label>
            <input type="text" id="author" name="author" /> <br><br>
            <label for="datePublished">Date</label>
            <input type="text" id="datePublished" name="datePublished" /> <br><br>
            <label for="imageAvailable">Image Available?</label>
            <input type="file" id="imageAvailable" name="imageAvailable" /> <br><br>
            <label for="articleText">Article Text</label>
            <input type="text" id="articleText" name="articleText" /> <br><br>
            <label for="publisher">Publisher</label>
            <input type="text" id="publisher" name="publisher" /> <br><br>
            <label for="url">Source URL</label>
            <input type="url" id="url" name="url" /> <br><br>
            <button type="submit">Submit!</button>
        </form>
        <!--<p id="outputArea"></p>-->
    </body>
</html>
