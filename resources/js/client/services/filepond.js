export async function urlToFilePondObject(file) {
  const response = await fetch(file.url)
  const blob = await response.blob()
  return {
    source: blob,
    options: {
      type: 'local',
      metadata: {
        object_name: file.object_name
      }
    }
  }
}