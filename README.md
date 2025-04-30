# braican.com

This is the public repository of [braican.com](https://braican.com), the portfolio website for Nick Braica.

## Setup and development

This site requires Node.js. The easiest way to ensure you're using the right version of node is to use [Node Version Manager](https://github.com/nvm-sh/nvm). From there, all that's left to do is install the dependencies via `npm` and start the local development server.

### Installation

```shell
# Assuming you have nvm...
nvm install

# Intall dependencies.
npm install
```

### Development

```shell
# Start the dev server.
npm start
```

### Building for production

```shell
# Build the static site and assets.
npm run build
```

## The Versions

### v8

Released 01/07/2025

![v8](assets/braican.com-v8.png?raw=true)

The eighth version of the site sees more simplification. I've ditched the overhead of WordPress for [Pages CMS](https://pagescms.org/) and built the site itself using [11ty](https://www.11ty.dev/). The build process has also been simplified, as 11ty handles the bundling and compilation of all static assets like css and JavaScript (although there is no JavaScript loaded on the site as of 8.0.0 other than Google Analytics). This is in contrast to the fairly involved Webpack configuration of previous iterations. From a design perspective, not much changes - it remains a simple text-centric site with an intro and a list of projects (for now). [Chivo](https://fonts.google.com/specimen/Chivo) is the font used on the site, served from Google Fonts. I have grand ideas of further highlighting case studies and including shorter-form articles, but we'll see where that ever goes.

### v7

Released 08/18/2019

![v7](assets/braican.com-v7.png?raw=true)

Version seven moves the tech stack to using Gatsby to generate the static, single page site. The design moves to a more text-centric approach; no more corny images for projects, for example. It continues to use WordPress to manage and serve content to the application.

### v6

Released 07/09/2018

![v6](assets/braican.com-v6.2.3.png?raw=true)

Version six is a slight aesthetic improvement, but a total overhaul in the technology and the code behind the site. I kept WordPress on to handle my content, but am using it solely as a platform to create a content API that provides json endpoints for the data. The front end is handled by Hugo, a static site generator. The json data is downloaded via a gulp task that Hugo then renders.

The reasoning for the change was simple - I don't have that much content, and I didn't need an entire CMS to handle just some case studies and an introduction.

### v5

Released 01/06/2018

![v5](assets/braican.com-v5.jpg?raw=true)

The fifth iteration of braican.com saw a focus on a simpler approach. A brief intro, thumbnails of projects that link to brief case studies, and a contact form make up the whole site. This version is completely powered by WordPress.

I started working on the site on December 8, 2017, and initially launched it about a month later.

### v4

Released 03/19/2014

![v4](assets/braican.com-v4.jpg?raw=true)

Moving to a CMS driven site for the first time, I developed a custom, one page WordPress theme that consisted of sections for my work, about me, and contact links. This is the first braican.com iteration to be fully responsive. I utilized AJAX and the HTML5 history API to navigate to the portfolio items and case studies. To date, this has been the longest running braican.com iteration.

### v3

Released 09/30/2011

![v3](assets/braican.com-v3.jpg?raw=true)

Another static site with WordPress driving the blogging funtionality. This iteration was a complete redesign from the previous site, and featured large banners across each page with a fixed, full-screen image. This site is not responsive, but does include some nifty animations throughout. And man, I really liked those sliders on the homepage.

This is the site that was live when I was hired as a co-op at The Boston Globe, as well as when I graduated from college and was hired full-time by Tank Design. So I guess you could say that this one was good enough to get me a couple jobs.

### v2

Released 10/20/2010

![v2](assets/braican.com-v2.jpg?raw=true)

A modification of the first iteration, this was a static html site that used WordPress only to power the blog. This version highlighted the breadth of work that I had completed up until that point, which included a slew of classwork and other personal projects in several different mediums that were completed throughout the years.

I was also able to highlight The Girl From Last Night, perhaps the college project I'm most proud of.

### v1

Released ??/??/??

This one's been lost to time. It was a very basic, static site that highlighted some schoolwork. There was a really cool grayscale gradient background.
