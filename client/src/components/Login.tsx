import React from 'react'
import { Button, Flex, FlexItem, Heading, TextInput, View } from '@instructure/ui'
import { useNavigate } from 'react-router-dom'

export default function Login() {
	const navigate = useNavigate()

	return (
		<View maxWidth='25em' margin='0 auto' display='block' className='Login'>
			<Heading level='h3' margin='small 0 medium 0'>
				Login
			</Heading>
			<View as='div' margin='medium 0'>
				<TextInput renderLabel='Email' type='email' />
			</View>
			<View as='div' margin='medium 0'>
				<TextInput renderLabel='Password' type='password' />
			</View>
			<Flex direction='row' justifyItems='space-between'>
				<FlexItem>
					<Button color='primary-inverse' onClick={() => navigate('/register')}>
						Go to Register
					</Button>
				</FlexItem>
				<FlexItem>
					<Button color='primary-inverse'>Login</Button>
				</FlexItem>
			</Flex>
		</View>
	)
}
