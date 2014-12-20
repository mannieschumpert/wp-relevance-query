# WP Relevance Query

Extends WP_Query to allow for post queries sorted by relevance.

## Use Case
WP Relevance Query is for when you need to do a post query with multiple taxonomy terms, and sort the posts based on which ones are most relevant (have the highest number of desired terms).

How often do you need need to run a post query where you need to sort the resulting posts by relevance? Probably not very often. But I found the need in a client project, so I figured others would, too.

## Usage
Run a WP Relevance Query by instantiating a query object, just like you normally would:
`$my_query = new WP_Relevance_Query( $args );`

## Behavior
- If `orderby` is included in query arguments, that will be the secondary post order. (Posts are always ordered first by relevance.)

#### TODO
- Meta and author queries included in calculating relevance
- Possibly add parameters for giving more weight to certain arguments (e.g. author more important to relevance than terms)