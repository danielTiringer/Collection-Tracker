import {Text, TopNavBar, View} from "@instructure/ui";

function Navbar() {
    return (
        <View as="div" margin="medium 0">
            <TopNavBar>
                {() => (
                    <TopNavBar.Layout
                        navLabel="Navbar"
                        desktopConfig={{
                            hideActionsUserSeparator: false
                        }}
                        smallViewportConfig={{
                            dropdownMenuToggleButtonLabel: 'Toggle Menu',
                            dropdownMenuLabel: 'Main Menu',
                        }}
                        renderBrand={(
                            <TopNavBar.Brand
                                screenReaderLabel="Collection Tracker"
                                renderName={(
                                    <View as="div" minWidth="7rem">
                                        <Text
                                            as="div"
                                            color="primary-inverse"
                                            transform="uppercase"
                                            size="small"
                                            weight="bold"
                                            lineHeight="condensed"
                                        >
                                            Collection Tracker
                                        </Text>
                                    </View>
                                )}
                                nameBackground="#2D3B45"
                                href="/"
                            />
                        )}
                        renderUser={(
                            <TopNavBar.User>
                                <TopNavBar.Item
                                    id="LogInButton"
                                    href="/login"
                                >
                                    Log In
                                </TopNavBar.Item>
                                <TopNavBar.Item
                                    id="RegisterButton"
                                    href="/register"
                                >
                                    Register
                                </TopNavBar.Item>
                            </TopNavBar.User>
                        )}
                    />
                )}
            </TopNavBar>
        </View>
    )
}

export default Navbar