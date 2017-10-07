import { should } from 'chai'
should()

import { test } from './app'

describe('Test if testing works', () => {
    it('True should be true', () => {
        test().should.be.true
    })

    it('True should not be false', () => {
        test().should.not.be.false
    })
})