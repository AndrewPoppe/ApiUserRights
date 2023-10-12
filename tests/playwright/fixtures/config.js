exports.config = {
    module: {
        name: 'api_user_rights',
        version: '',
    },
    redcapVersion: 'redcap_v13.1.27',
    redcapUrl: 'http://localhost:13740',
    projects: {
        Project: {
            projectName: 'API User Rights - Test Project',
            pid: 298,
            xml: 'data_files/TestProject.xml'
        }
    },
    roles: {
        Test: {
            id: null,
            name: 'Test',
            uniqueRoleName: null
        }
    },
    users: {
        NormalUser1: {
            username: 'alice',
            password: 'password'
        },
        NormalUser2: {
            username: 'bob',
            password: 'password'
        },
        AdminUser: {
            username: 'admin',
            password: 'password'
        }
    },
    participants: {
        Participant1: {
            firstName: 'Test',
            lastName: 'User1',
            email: 'test@user1.com',
            password: 'Password1!'
        },
        Participant2: {
            firstName: 'Test',
            lastName: 'User2',
            email: 'test@user2.com'
        }
    },
    system_em_framework_config: {

    },
    project_em_framework_config: {

    }
}