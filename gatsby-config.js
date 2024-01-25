const path = require('path');

require('dotenv').config();

module.exports = {
  siteMetadata: {
    title: `Nick Braica builds digital products.`,
    description: `Nick Braica is a design-focused web developer who builds exceptional online experiences.`,
    author: `Nick Braica <nick.braica@gmail.com>`,
  },
  plugins: [
    `gatsby-plugin-react-helmet`,
    // {
    //   resolve: `gatsby-source-filesystem`,
    //   options: {
    //     name: `images`,
    //     path: `${__dirname}/src/images`,
    //   },
    // },

    `gatsby-transformer-sharp`,
    `gatsby-plugin-sharp`,
    {
      resolve: 'gatsby-source-wordpress',
      options: {
        baseUrl: process.env.WORDPRESS_SOURCE_URL,
        protocol: `https`,
        hostingWPCOM: false,

        useACF: false,

        // DEBUG - set to true to debug gatsby running to get data from the endpoints.
        verboseOutput: true,

        includedRoutes: ['**/braican/v1/projects', '**/braican/v1/front'],
      },
    },
    {
      resolve: 'gatsby-plugin-web-font-loader',
      options: {
        typekit: {
          id: 'vcr6sxy',
        },
      },
    },
    {
      resolve: 'gatsby-plugin-sass',
      options: {
        data: `@import 'abstracts';`,
        includePaths: [path.resolve(__dirname, 'src/styles')],
      },
    },
    {
      resolve: 'gatsby-plugin-google-analytics',
      options: {
        trackingId: 'UA-20596099-3',
      },
    },
  ],
};
