SELECT
    article.id,
    article.title,
    article.body,
    article.published_date,
    photo.id AS photo_id

FROM
    blog_articles AS article

LEFT JOIN
    blog_photos AS photo ON
    (
        photo.article_id = article.id
        AND
        photo.display_order = 1
    )

WHERE
    article.status = 'Published'

ORDER BY
    article.published_date DESC

LIMIT 4