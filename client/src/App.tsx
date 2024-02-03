import {Button, InstUISettingsProvider, canvas} from '@instructure/ui'

function App() {
    return (
        <InstUISettingsProvider theme={canvas}>
            <Button>Hello from InstUI!</Button>
        </InstUISettingsProvider>
    )
}

export default App