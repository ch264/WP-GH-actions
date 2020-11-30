# A WordPress Plugin to Rebuild Your Gatsby App on AWS using GitHub Actions

You can find the full blog post here https://www.twilio.com/blog/create-wordpress-plugin-rebuild-gatsby-app-aws-github-actions

## Prerequisites

> Your WordPress CMS has already been connected to your Gatsby App. If not, this blog post will help you get started.
> Your Gatsby App has been successfully deployed to AWS/S3 using Github Actions. At this time, Github does not provide a re-run button for Github Actions. I have written a concise tutorial on how to run GitHub Actions manually using Postman client.

## The Workflow

Here is what you need to do in order to get this plugin to work

> Create a folder containing one PHP file
> Hook into WordPress actions to create admin dashboard menu item
> Create a button with onClick to POST to GitHub Actions API to re-publish the Gatsby App to AWS/S3
> Create a personal token in GitHub to use for GitHub Actions API authorization
> Create zip file of plugin folder, upload to wordpress and activate
