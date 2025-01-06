import esbuild from 'esbuild';

export default async function (eleventyConfig) {
  const env = process.env.ENVIRONMENT;

  eleventyConfig.addTemplateFormats('css');
  eleventyConfig.addExtension('css', {
    outputFileExtension: 'css',
    compile: () => {
      esbuild.buildSync({
        entryPoints: ['./src/static/css/app.css'],
        bundle: true,
        minify: env === 'production',
        sourcemap: env !== 'production',
        outfile: './_site/build/app.css',
      });
    },
  });

  eleventyConfig.addTemplateFormats('js');
  eleventyConfig.addExtension('js', {
    outputFileExtension: 'js',
    compile: () => {
      esbuild.build({
        entryPoints: ['./src/static/js/app.js'],
        bundle: true,
        minify: env === 'production',
        sourcemap: env !== 'production',
        outfile: './_site/build/app.js',
        target: ['es2020'],
      });
    },
  });

  return {
    dir: {
      input: 'src',
    },
  };
}
