export default () => {
  return {
    currentYear: (() => {
      const today = new Date();
      return today.getFullYear();
    })()
  }
}
