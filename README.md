# WP Relevance Query

**Extends WP_Query to allow for post queries sorted by relevance.**

WP Relevance Query is for when you need to do a post query with multiple taxonomy terms, and sort the posts based on which ones are most relevant (have the highest number of desired terms).

How often do you need need to run a post query where you need to sort the resulting posts by relevance? Probably not very often. But I found the need in a client project, so I figured others would, too.

## Usage
Run a WP Relevance Query by instantiating a query object, just like you normally would:
`$my_query = new WP_Relevance_Query( $args );`

After retrieving the posts that match the given terms, for each post, the taxonomy terms are retrieved and added to the post object. The post's terms are then compared to the queried terms, and a relevance score is calculated and added to the post object. The posts are then sorted by relevance.

- If `orderby` is included in query arguments, that will be the secondary post order. (Posts are always ordered first by relevance.)
(orderby functionality isn't available yet - secondary ordering currently defaults to post_date)
- Note that the posts terms are added to the post object. If you want to use the terms in your template, you don't need to query for them again.

## Warnings
Querying via WP_Relevance_Query has the potential to be a very, very expensive database operation. Be sure to cache whenever possible.

### TODO
- Allow query by term slugs (currently only uses ID)
- Meta and author queries included in calculating relevance
- Possibly add parameters for giving more weight to certain arguments (e.g. author more important to relevance than terms)
- Add option to only return posts above a given relevance score
- Add template tag for printing post's relevance score
- Add caching methods?