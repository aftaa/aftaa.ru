module.exports = (api) => {
  api.cache(true)

  return {
    presets: [
      ['@babel/preset-env', { modules: false }],
      '@babel/preset-react',
      '@babel/preset-typescript'
    ],
    plugins: [
      // ['@babel/plugin-proposal-decorators', { legacy: true }],
      // ['@babel/plugin-proposal-class-properties', { loose: true }]
    ]
  }
}
