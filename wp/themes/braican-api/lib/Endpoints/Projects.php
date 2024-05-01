<?php

/**
 * Gets the projects.
 *
 * @package BraicanApi
 */

namespace BraicanApi\Endpoints;

/**
 * Build the endpoint for Projects.
 */
class Projects extends Base
{
	/**
	 * The function that will return the content for the endpoint.
	 *
	 * @param array $request Data in the request.
	 *
	 * @return array
	 */
	public function get_content($request)
	{
		$project_posts = get_posts(
			array(
				'posts_per_page' => 20,
				'post_type'      => 'project',
				'post_status'    => 'publish',
				'orderby'        => 'post_date',
				'order'          => 'desc'
			)
		);

		$projects = array_map(
			function ($prj) {
				$link = get_field('braican_project_link', $prj->ID);
				return array(
					'title' => $prj->post_title,
					'link'  => $link ? $link['url'] : null,
				);
			},
			$project_posts
		);

		return array(
			'wordpress_id' => 1,
			'projects'     => $projects,
		);
	}
}
